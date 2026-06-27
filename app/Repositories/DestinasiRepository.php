<?php

namespace App\Repositories;

use App\Models\Destinasi;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class DestinasiRepository
{
    public function getAllAktif(): Collection
    {
        return Destinasi::aktif()
            ->with(['kategori', 'galeri'])
            ->orderByDesc('dibuat_pada')
            ->get();
    }

    public function getPopuler(int $limit = 6): Collection
    {
        return Cache::remember('destinasi_populer', 3600, function () use ($limit) {
            return Destinasi::aktif()
                ->with('kategori')
                ->inRandomOrder()
                ->limit($limit)
                ->get();
        });
    }

    public function findById(int $id): ?Destinasi
    {
        return Destinasi::with(['kategori', 'galeri'])->find($id);
    }

    public function findByNama(string $nama): ?Destinasi
    {
        return Destinasi::aktif()
            ->with(['kategori', 'galeri'])
            ->where('nama', $nama)
            ->firstOrFail();
    }

    public function getRekomendasiSerupa(Destinasi $destinasi, int $limit = 4): Collection
    {
        return Destinasi::aktif()
            ->with('kategori')
            ->where('id_kategori', $destinasi->id_kategori)
            ->where('id_destinasi', '!=', $destinasi->id_destinasi)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    public function paginate(
        int $perPage = 12,
        ?string $search = null,
        ?int $kategoriId = null,
        ?string $jarak = null,
        ?string $harga = null,
        ?bool $buka24Jam = null,
        ?string $sortBy = null,
        ?string $sortOrder = 'asc'
    ): LengthAwarePaginator {
        $query = Destinasi::aktif()->with('kategori');

        if ($search) {
            $query->search($search);
        }

        if ($kategoriId) {
            $query->byKategori($kategoriId);
        }

        if ($jarak) {
            [$min, $max] = $this->parseRangeFilter($jarak);
            if ($max !== null) {
                $query->filterJarak($min, $max);
            } else {
                $query->filterJarak($min);
            }
        }

        if ($harga) {
            [$min, $max] = $this->parseRangeFilter($harga);
            if ($max !== null) {
                $query->filterHarga($min, $max);
            } else {
                $query->filterHarga($min);
            }
        }

        if ($buka24Jam) {
            $query->buka24Jam();
        }

        $allowedSorts = ['nama', 'harga_tiket', 'jarak_km', 'dibuat_pada'];
        $sortBy = in_array($sortBy, $allowedSorts) ? $sortBy : 'dibuat_pada';
        $sortOrder = $sortOrder === 'asc' ? 'asc' : 'desc';

        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    public function getFilteredForChatbot(
        ?int $kategoriId = null,
        ?string $jarak = null,
        ?string $anggaran = null,
        int $limit = 5
    ): Collection {
        $query = Destinasi::aktif()->with('kategori');

        if ($kategoriId) {
            $query->byKategori($kategoriId);
        }

        if ($jarak) {
            [$min, $max] = $this->parseRangeFilter($jarak);
            if ($max !== null) {
                $query->filterJarak($min, $max);
            } else {
                $query->filterJarak($min);
            }
        }

        if ($anggaran) {
            [$min, $max] = $this->parseAnggaranFilter($anggaran);
            if ($max !== null) {
                $query->filterHarga($min, $max);
            } else {
                $query->filterHarga($min);
            }
        }

        return $query->inRandomOrder()->limit($limit)->get();
    }

    public function create(array $data): Destinasi
    {
        Cache::forget('destinasi_populer');
        return Destinasi::create($data);
    }

    public function update(Destinasi $destinasi, array $data): Destinasi
    {
        Cache::forget('destinasi_populer');
        $destinasi->update($data);
        return $destinasi->fresh();
    }

    public function delete(Destinasi $destinasi): bool
    {
        Cache::forget('destinasi_populer');
        return $destinasi->delete();
    }

    public function countAktif(): int
    {
        return Destinasi::aktif()->count();
    }

    public function countTotal(): int
    {
        return Destinasi::count();
    }

    private function parseRangeFilter(string $value): array
    {
        return match ($value) {
            '<10' => [0, 10],
            '10-25' => [10, 25],
            '25-50' => [25, 50],
            '>50' => [50, null],
            default => [0, null],
        };
    }

    private function parseAnggaranFilter(string $value): array
    {
        return match ($value) {
            'gratis' => [0, 0],
            '<10000' => [1, 9999],
            '10000-20000' => [10000, 20000],
            '>20000' => [20000, null],
            default => [0, null],
        };
    }
}
