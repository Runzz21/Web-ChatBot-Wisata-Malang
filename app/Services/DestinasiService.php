<?php

namespace App\Services;

use App\Models\Destinasi;
use App\Repositories\DestinasiRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class DestinasiService
{
    public function __construct(
        private DestinasiRepository $destinasiRepository
    ) {}

    public function getPopuler(int $limit = 6): Collection
    {
        return $this->destinasiRepository->getPopuler($limit);
    }

    public function findById(int $id): ?Destinasi
    {
        return $this->destinasiRepository->findById($id);
    }

    public function findByNama(string $nama): Destinasi
    {
        return $this->destinasiRepository->findByNama($nama);
    }

    public function getRekomendasiSerupa(Destinasi $destinasi, int $limit = 4): Collection
    {
        return $this->destinasiRepository->getRekomendasiSerupa($destinasi, $limit);
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
        return $this->destinasiRepository->paginate(
            $perPage, $search, $kategoriId, $jarak, $harga, $buka24Jam, $sortBy, $sortOrder
        );
    }

    public function getFilteredForChatbot(
        ?int $kategoriId = null,
        ?string $jarak = null,
        ?string $anggaran = null,
        int $limit = 5
    ): Collection {
        return $this->destinasiRepository->getFilteredForChatbot(
            $kategoriId, $jarak, $anggaran, $limit
        );
    }

    public function create(array $data, $fotoUtama = null): Destinasi
    {
        if ($fotoUtama) {
            $data['foto_utama'] = $fotoUtama->store('destinasi', 'public');
        }

        return $this->destinasiRepository->create($data);
    }

    public function update(Destinasi $destinasi, array $data, $fotoUtama = null): Destinasi
    {
        if ($fotoUtama) {
            if ($destinasi->foto_utama && Storage::disk('public')->exists($destinasi->foto_utama)) {
                Storage::disk('public')->delete($destinasi->foto_utama);
            }
            $data['foto_utama'] = $fotoUtama->store('destinasi', 'public');
        }

        return $this->destinasiRepository->update($destinasi, $data);
    }

    public function delete(Destinasi $destinasi): bool
    {
        if ($destinasi->foto_utama && Storage::disk('public')->exists($destinasi->foto_utama)) {
            Storage::disk('public')->delete($destinasi->foto_utama);
        }

        foreach ($destinasi->galeri as $galeri) {
            if ($galeri->url_foto && Storage::disk('public')->exists($galeri->url_foto)) {
                Storage::disk('public')->delete($galeri->url_foto);
            }
        }

        return $this->destinasiRepository->delete($destinasi);
    }

    public function countAktif(): int
    {
        return $this->destinasiRepository->countAktif();
    }

    public function countTotal(): int
    {
        return $this->destinasiRepository->countTotal();
    }
}
