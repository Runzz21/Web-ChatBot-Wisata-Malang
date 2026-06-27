<?php

namespace App\Services;

use App\Repositories\ChatbotLogRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ChatbotLogService
{
    public function __construct(
        private ChatbotLogRepository $chatbotLogRepository
    ) {}

    public function logSearch(
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

    public function paginate(
        int $perPage = 20,
        ?string $search = null,
        ?int $kategoriId = null,
        ?string $tanggalMulai = null,
        ?string $tanggalAkhir = null
    ): LengthAwarePaginator {
        return $this->chatbotLogRepository->paginate(
            $perPage, $search, $kategoriId, $tanggalMulai, $tanggalAkhir
        );
    }

    public function getAllForExport(
        ?int $kategoriId = null,
        ?string $tanggalMulai = null,
        ?string $tanggalAkhir = null
    ): Collection {
        return $this->chatbotLogRepository->getAll($kategoriId, $tanggalMulai, $tanggalAkhir);
    }

    public function countTotal(): int
    {
        return $this->chatbotLogRepository->countTotal();
    }
}
