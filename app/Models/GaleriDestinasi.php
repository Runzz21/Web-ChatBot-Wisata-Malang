<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class GaleriDestinasi extends Model
{
    protected $table = 'galeri_destinasi';
    protected $primaryKey = 'id_galeri';
    public $timestamps = false;

    protected $fillable = [
        'id_destinasi',
        'url_foto',
        'urutan',
    ];

    protected $appends = ['foto_url'];

    public function destinasi(): BelongsTo
    {
        return $this->belongsTo(Destinasi::class, 'id_destinasi', 'id_destinasi');
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->url_foto && Storage::disk('public')->exists($this->url_foto)) {
            return Storage::url($this->url_foto);
        }
        return 'https://placehold.co/800x600?text=Galeri+Wisata';
    }
}
