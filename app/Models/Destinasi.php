<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Destinasi extends Model
{
    protected $table = 'destinasi';
    protected $primaryKey = 'id_destinasi';
    public $timestamps = false;

    const CREATED_AT = 'dibuat_pada';

    protected $fillable = [
        'nama',
        'id_kategori',
        'lokasi',
        'ketinggian_mdpl',
        'jarak_km',
        'harga_tiket',
        'jam_buka',
        'jam_tutup',
        'buka_24jam',
        'deskripsi',
        'foto_utama',
        'fasilitas',
        'status_aktif',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'ketinggian_mdpl' => 'integer',
        'jarak_km' => 'decimal:2',
        'harga_tiket' => 'decimal:2',
        'buka_24jam' => 'boolean',
        'status_aktif' => 'boolean',
    ];

    protected $appends = [
        'foto_url',
        'fasilitas_array',
        'formatted_harga',
        'formatted_jarak',
        'status_buka',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function galeri(): HasMany
    {
        return $this->hasMany(GaleriDestinasi::class, 'id_destinasi', 'id_destinasi')
            ->orderBy('urutan');
    }

    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function scopeByKategori($query, $idKategori)
    {
        return $query->where('id_kategori', $idKategori);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('nama', 'like', "%{$term}%")
              ->orWhere('lokasi', 'like', "%{$term}%");
        });
    }

    public function scopeFilterJarak($query, $min, $max = null)
    {
        if ($max !== null) {
            return $query->whereBetween('jarak_km', [$min, $max]);
        }
        return $query->where('jarak_km', '>=', $min);
    }

    public function scopeFilterHarga($query, $min, $max = null)
    {
        if ($max !== null) {
            return $query->whereBetween('harga_tiket', [$min, $max]);
        }
        return $query->where('harga_tiket', '>=', $min);
    }

    public function scopeBuka24Jam($query)
    {
        return $query->where('buka_24jam', true);
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto_utama && Storage::disk('public')->exists($this->foto_utama)) {
            return Storage::url($this->foto_utama);
        }
        return 'https://placehold.co/800x600?text=Wisata+Alam+Malang';
    }

    public function getFasilitasArrayAttribute(): array
    {
        if (empty($this->fasilitas)) {
            return [];
        }
        return array_map('trim', explode(',', $this->fasilitas));
    }

    public function getFormattedHargaAttribute(): string
    {
        if ($this->harga_tiket == 0 || $this->harga_tiket === null) {
            return 'Gratis';
        }
        return 'Rp ' . number_format($this->harga_tiket, 0, ',', '.');
    }

    public function getFormattedJarakAttribute(): string
    {
        return number_format($this->jarak_km, 1, ',', '.') . ' km';
    }

    public function getStatusBukaAttribute(): string
    {
        if ($this->buka_24jam) {
            return 'Buka 24 Jam';
        }
        $now = now()->format('H:i');
        if ($now >= $this->jam_buka && $now <= $this->jam_tutup) {
            return 'Buka';
        }
        return 'Tutup';
    }

}
