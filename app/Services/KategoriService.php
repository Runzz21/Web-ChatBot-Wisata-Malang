<?php

namespace App\Services;

use App\Models\Kategori;
use App\Repositories\KategoriRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class KategoriService
{
    public function __construct(
        private KategoriRepository $kategoriRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->kategoriRepository->getAllCached();
    }

    public function getPopuler(int $limit = 6): Collection
    {
        return $this->kategoriRepository->getPopuler($limit);
    }

    public function findById(int $id): ?Kategori
    {
        return $this->kategoriRepository->findById($id);
    }

    public function findBySlug(string $slug): ?Kategori
    {
        return $this->kategoriRepository->findBySlug($slug);
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->kategoriRepository->paginate($perPage);
    }

    public function search(string $term, int $perPage = 10): LengthAwarePaginator
    {
        return $this->kategoriRepository->search($term, $perPage);
    }

    public function create(array $data): Kategori
    {
        return $this->kategoriRepository->create($data);
    }

    public function update(Kategori $kategori, array $data): Kategori
    {
        return $this->kategoriRepository->update($kategori, $data);
    }

    public function delete(Kategori $kategori): bool
    {
        if ($kategori->destinasions()->count() > 0) {
            throw new \Exception('Kategori tidak dapat dihapus karena masih memiliki destinasi terkait.');
        }
        return $this->kategoriRepository->delete($kategori);
    }
}
