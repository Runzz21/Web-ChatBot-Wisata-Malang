<?php

namespace App\Services;

use App\Repositories\DestinasiRepository;
use App\Repositories\ChatbotLogRepository;
use Illuminate\Database\Eloquent\Collection;

class ChabotService
{
    public function __construct(
        private DestinasiRepository $destinasiRepository,
        private ChatbotLogRepository $chatbotLogRepository
    ) {}

    public function getRecommendations(
        ?int $kategoriId,
        ?string $jarak,
        ?string $anggaran,
        int $limit = 5
    ): Collection {
        return $this->destinasiRepository->getFilteredForChatbot(
            $kategoriId, $jarak, $anggaran, $limit
        );
    }

    public function saveSearchLog(
        string $sesiId,
        ?int $kategoriId,
        ?string $jarakPilihan,
        ?string $anggaranPilihan,
        int $jumlahHasil
    ): void {
        $this->chatbotLogRepository->create([
            'sesi_id' => $sesiId,
            'id_kategori' => $kategoriId,
            'jarak_pilihan' => $jarakPilihan,
            'anggaran_pilihan' => $anggaranPilihan,
            'jumlah_hasil' => $jumlahHasil,
        ]);
    }

    public function getJarakOptions(): array
    {
        return [
            ['value' => '<10', 'label' => '< 10 km'],
            ['value' => '10-25', 'label' => '10 - 25 km'],
            ['value' => '25-50', 'label' => '25 - 50 km'],
            ['value' => '>50', 'label' => '> 50 km'],
        ];
    }

    public function getAnggaranOptions(): array
    {
        return [
            ['value' => '', 'label' => 'Semua Anggaran'],
            ['value' => 'gratis', 'label' => 'Gratis (Rp 0)'],
            ['value' => '<10000', 'label' => '< Rp 10.000'],
            ['value' => '10000-20000', 'label' => 'Rp 10.000 - Rp 20.000'],
            ['value' => '>20000', 'label' => '> Rp 20.000'],
        ];
    }
}
