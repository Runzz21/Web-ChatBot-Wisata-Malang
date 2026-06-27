<?php

namespace App\Repositories;

use App\Models\ChatbotLog;
use Illuminate\Pagination\LengthAwarePaginator;

class ChatbotLogRepository
{
    public function create(array $data): ChatbotLog
    {
        return ChatbotLog::create($data);
    }

    public function paginate(
        int $perPage = 20,
        ?string $search = null,
        ?int $kategoriId = null,
        ?string $tanggalMulai = null,
        ?string $tanggalAkhir = null
    ): LengthAwarePaginator {
        $query = ChatbotLog::with('kategori')->orderByDesc('dibuat_pada');

        if ($search) {
            $query->where('sesi_id', 'like', "%{$search}%");
        }

        if ($kategoriId) {
            $query->where('id_kategori', $kategoriId);
        }

        if ($tanggalMulai) {
            $query->whereDate('dibuat_pada', '>=', $tanggalMulai);
        }

        if ($tanggalAkhir) {
            $query->whereDate('dibuat_pada', '<=', $tanggalAkhir);
        }

        return $query->paginate($perPage);
    }

    public function getAll(?int $kategoriId = null, ?string $tanggalMulai = null, ?string $tanggalAkhir = null)
    {
        $query = ChatbotLog::with('kategori')->orderByDesc('dibuat_pada');

        if ($kategoriId) {
            $query->where('id_kategori', $kategoriId);
        }

        if ($tanggalMulai) {
            $query->whereDate('dibuat_pada', '>=', $tanggalMulai);
        }

        if ($tanggalAkhir) {
            $query->whereDate('dibuat_pada', '<=', $tanggalAkhir);
        }

        return $query->get();
    }

    public function countTotal(): int
    {
        return ChatbotLog::count();
    }
}
