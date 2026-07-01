<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected string $apiKey;
    protected string $endpoint;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.groq.api_key');
        $this->endpoint = 'https://api.groq.com/openai/v1/chat/completions';
        $this->model = 'llama-3.3-70b-versatile';
    }

    public function generate(string $prompt, array $context = []): string
    {
        if (empty($this->apiKey)) {
            Log::warning('Groq API key tidak dikonfigurasi');
            return '';
        }

        $systemMessage = $this->buildSystemInstruction($context);

        $response = Http::timeout(30)
            ->withToken($this->apiKey)
            ->post($this->endpoint, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemMessage],
                    ['role' => 'user', 'content' => $prompt],
                ],
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

        if ($response->failed()) {
            Log::error('Groq API error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return '';
        }

        return $response->json('choices.0.message.content') ?? '';
    }

    public function generateRecommendation(array $preferences, array $destinations): string
    {
        $destinasiText = collect($destinations)->map(function ($d, $i) {
            $nama = $d['nama'] ?? $d->nama ?? '-';
            $lokasi = $d['lokasi'] ?? $d->lokasi ?? '-';
            $harga = $d['formatted_harga'] ?? ($d->harga_tiket ?? 'Gratis');
            $jarak = $d['formatted_jarak'] ?? ($d->jarak_km ?? '-') . ' km';
            return ($i + 1) . ". {$nama} - {$lokasi} (Rp {$harga}, {$jarak})";
        })->implode("\n");

        $prompt = "Pengguna mencari wisata alam di Malang dengan preferensi:\n"
            . "- Kategori: {$preferences['kategori']}\n"
            . "- Jarak: {$preferences['jarak']}\n"
            . "- Anggaran: {$preferences['anggaran']}\n\n"
            . "Berikut destinasi yang cocok:\n{$destinasiText}\n\n"
            . "Buat kalimat rekomendasi yang ramah dan natural dalam Bahasa Indonesia (boleh campur Jawa/Malangan). "
            . "Jelaskan secara singkat kenapa destinasi ini cocok untuk pengguna.";

        return $this->generate($prompt, [
            'role' => 'Asisten Wisata Malang',
            'tone' => 'ramah, santai, bahasa Jawa campur Indonesia (Ngoko)',
        ]);
    }

    public function chatFree(string $userMessage, array $history, string $destinasiContext): string
    {
        if (empty($this->apiKey)) {
            Log::warning('Groq API key tidak dikonfigurasi');
            return 'Maaf, layanan AI sedang tidak tersedia.';
        }

        $messages = [];

        $messages[] = [
            'role' => 'system',
            'content' => "Kamu adalah Asisten Wisata Malang yang ramah dan membantu. "
                . "Gunakan bahasa Indonesia santai (boleh campur Jawa/Malangan). "
                . "Berikut adalah data DESTINASI WISATA ALAM di Malang Raya:\n\n"
                . "{$destinasiContext}\n\n"
                . "ATURAN:\n"
                . "1. Hanya rekomendasikan destinasi dari daftar di atas\n"
                . "2. Jika pengguna bertanya di luar wisata Malang, arahkan kembali\n"
                . "3. Sertakan detail: lokasi, jarak, harga tiket\n"
                . "4. Jika tidak ada yang cocok, bilang dengan sopan\n"
                . "5. Jawab dengan hangat dan natural",
        ];

        foreach ($history as $msg) {
            $role = $msg['role'] === 'user' ? 'user' : 'assistant';
            $messages[] = ['role' => $role, 'content' => $msg['content']];
        }

        $messages[] = ['role' => 'user', 'content' => $userMessage];

        $response = Http::timeout(30)
            ->withToken($this->apiKey)
            ->post($this->endpoint, [
                'model' => $this->model,
                'messages' => $messages,
                'temperature' => 0.8,
                'max_tokens' => 800,
            ]);

        if ($response->failed()) {
            Log::error('Groq chat error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            return 'Maaf, terjadi kesalahan. Coba lagi ya.';
        }

        return $response->json('choices.0.message.content') ?? 'Maaf, aku gak bisa jawab sekarang.';
    }

    protected function buildSystemInstruction(array $context): string
    {
        $role = $context['role'] ?? 'Asisten wisata';
        $tone = $context['tone'] ?? 'ramah dan informatif';

        return "Kamu adalah {$role} yang membantu pengguna menemukan destinasi wisata alam di Malang Raya. "
            . "Gunakan tone {$tone}. "
            . "Jawab dalam Bahasa Indonesia. "
            . "Kamu hanya boleh merekomendasikan destinasi yang sudah disebutkan dalam daftar. "
            . "Jangan menambahkan informasi palsu atau destinasi yang tidak ada dalam data.";
    }
}
