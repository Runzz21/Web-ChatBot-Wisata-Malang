<?php

namespace App\Repositories;

use App\Models\GaleriDestinasi;
use Illuminate\Database\Eloquent\Collection;

class GaleriRepository
{
    public function findByDestinasi(int $idDestinasi): Collection
    {
        return GaleriDestinasi::where('id_destinasi', $idDestinasi)
            ->orderBy('urutan')
            ->get();
    }

    public function create(array $data): GaleriDestinasi
    {
        return GaleriDestinasi::create($data);
    }

    public function delete(GaleriDestinasi $galeri): bool
    {
        return $galeri->delete();
    }

    public function deleteByDestinasi(int $idDestinasi): void
    {
        GaleriDestinasi::where('id_destinasi', $idDestinasi)->delete();
    }

    public function updateUrutan(int $idGaleri, int $urutan): void
    {
        GaleriDestinasi::where('id_galeri', $idGaleri)->update(['urutan' => $urutan]);
    }

    public function getNextUrutan(int $idDestinasi): int
    {
        $max = GaleriDestinasi::where('id_destinasi', $idDestinasi)->max('urutan');
        return ($max ?? 0) + 1;
    }

    public function countByDestinasi(int $idDestinasi): int
    {
        return GaleriDestinasi::where('id_destinasi', $idDestinasi)->count();
    }

    public function countTotal(): int
    {
        return GaleriDestinasi::count();
    }
}
