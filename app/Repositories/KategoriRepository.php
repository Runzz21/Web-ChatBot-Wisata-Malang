<?php

namespace App\Repositories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class KategoriRepository
{
    public function getAll(): Collection
    {
        return Kategori::withCount(['destinasions' => function ($q) {
            $q->where('status_aktif', true);
        }])->get();
    }

    public function getAllCached(): Collection
    {
        return Cache::rememberForever('kategori_all', function () {
            return $this->getAll();
        });
    }

    public function getPopuler(int $limit = 6): Collection
    {
        return Kategori::withCount(['destinasions' => function ($q) {
            $q->where('status_aktif', true);
        }])->having('destinasions_count', '>', 0)
            ->orderByDesc('destinasions_count')
            ->limit($limit)
            ->get();
    }

    public function findById(int $id): ?Kategori
    {
        return Kategori::find($id);
    }

    public function findBySlug(string $slug): ?Kategori
    {
        return Kategori::where('slug', $slug)->first();
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Kategori::withCount(['destinasions' => function ($q) {
            $q->where('status_aktif', true);
        }])->orderBy('nama_kategori')
            ->paginate($perPage);
    }

    public function search(string $term, int $perPage = 10): LengthAwarePaginator
    {
        return Kategori::where('nama_kategori', 'like', "%{$term}%")
            ->withCount(['destinasions'])
            ->orderBy('nama_kategori')
            ->paginate($perPage);
    }

    public function create(array $data): Kategori
    {
        Cache::forget('kategori_all');
        return Kategori::create($data);
    }

    public function update(Kategori $kategori, array $data): Kategori
    {
        Cache::forget('kategori_all');
        $kategori->update($data);
        return $kategori->fresh();
    }

    public function delete(Kategori $kategori): bool
    {
        Cache::forget('kategori_all');
        return $kategori->delete();
    }
}
