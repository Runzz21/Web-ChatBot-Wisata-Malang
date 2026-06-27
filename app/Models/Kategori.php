<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'slug',
        'warna_badge',
        'icon',
    ];

    protected static function booted(): void
    {
        static::creating(function (Kategori $kategori) {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama_kategori);
            }
        });

        static::updating(function (Kategori $kategori) {
            if ($kategori->isDirty('nama_kategori') && empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama_kategori);
            }
        });
    }

    public function destinasions(): HasMany
    {
        return $this->hasMany(Destinasi::class, 'id_kategori', 'id_kategori');
    }

    public function chatbotLogs(): HasMany
    {
        return $this->hasMany(ChatbotLog::class, 'id_kategori', 'id_kategori');
    }

    public function getJumlahDestinasiAttribute(): int
    {
        return $this->destinasions()->where('status_aktif', true)->count();
    }

}
