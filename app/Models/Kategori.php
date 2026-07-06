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

    public function getIconSvgAttribute(): string
    {
        $nama = strtolower($this->nama_kategori);

        $icons = [
            'gunung' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18l-6-12-4 6-3-4-5 10z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 100-4 2 2 0 000 4z"/></svg>',
            'pantai' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12h18"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3c1.5 2 3 4.5 3 9s-1.5 7-3 9"/></svg>',
            'air terjun' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v12m0 0l-3-3m3 3l3-3"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 16h14"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 20h16"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14v4"/></svg>',
            'keluarga' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
            'camping' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3L4 21h16L12 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v6"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 21l4-6 4 6"/></svg>',
            'danau' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12c0-3.5 4-7 9-7s9 3.5 9 7-4 7-9 7-9-3.5-9-7z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12h18"/></svg>',
            'goa' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 12a8 8 0 11-16 0 8 8 0 0116 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v16"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 12h16"/><circle cx="12" cy="12" r="3"/></svg>',
            'bukit' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2 21h20L16 3l-4 9-4-9-6 18z"/></svg>',
            'panas' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v4m0 0l-2-2m2 2l2-2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.93 4.93l2.83 2.83m0 0a5 5 0 108.48 0M6.34 7.76l-2.83-2.83M17.66 7.76l2.83-2.83"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14a3 3 0 100-6 3 3 0 000 6z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 19h8m-4-2v3"/></svg>',
            'sawah' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 21h18"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15h18"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 6l6-4 6 4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2v8"/></svg>',
            'hutan' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2L8 10h8L12 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 22l6-8 6 8"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 14H4l4-6"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 14h6l-4-6"/></svg>',
            'pemandian' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8h16"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 12h12"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4l2 2-2 2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 4l-2 2 2 2"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 16h14l-1 4H6l-1-4z"/></svg>',
            'petualangan' => '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>',
        ];

        foreach ($icons as $keyword => $svg) {
            if (str_contains($nama, $keyword)) {
                return $svg;
            }
        }

        return '<svg class="w-8 h-8 text-leaf-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>';
    }
}
