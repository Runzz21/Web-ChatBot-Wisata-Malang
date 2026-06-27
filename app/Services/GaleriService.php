<?php

namespace App\Services;

use App\Models\GaleriDestinasi;
use App\Repositories\GaleriRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class GaleriService
{
    public function __construct(
        private GaleriRepository $galeriRepository
    ) {}

    public function findByDestinasi(int $idDestinasi): Collection
    {
        return $this->galeriRepository->findByDestinasi($idDestinasi);
    }

    public function storeImages(int $idDestinasi, array $images): void
    {
        $urutan = $this->galeriRepository->getNextUrutan($idDestinasi);

        foreach ($images as $image) {
            $path = $image->store('galeri/' . $idDestinasi, 'public');
            $this->galeriRepository->create([
                'id_destinasi' => $idDestinasi,
                'url_foto' => $path,
                'urutan' => $urutan++,
            ]);
        }
    }

    public function delete(GaleriDestinasi $galeri): bool
    {
        if ($galeri->url_foto && Storage::disk('public')->exists($galeri->url_foto)) {
            Storage::disk('public')->delete($galeri->url_foto);
        }
        return $this->galeriRepository->delete($galeri);
    }

    public function deleteByDestinasi(int $idDestinasi): void
    {
        $galeriList = $this->galeriRepository->findByDestinasi($idDestinasi);
        foreach ($galeriList as $galeri) {
            if ($galeri->url_foto && Storage::disk('public')->exists($galeri->url_foto)) {
                Storage::disk('public')->delete($galeri->url_foto);
            }
        }
        $this->galeriRepository->deleteByDestinasi($idDestinasi);
    }

    public function updateUrutan(int $idGaleri, int $urutan): void
    {
        $this->galeriRepository->updateUrutan($idGaleri, $urutan);
    }

    public function countTotal(): int
    {
        return $this->galeriRepository->countTotal();
    }
}
