<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatbotLog extends Model
{
    protected $table = 'chatbot_log';
    protected $primaryKey = 'id_log';
    public $timestamps = false;

    const CREATED_AT = 'dibuat_pada';

    protected $fillable = [
        'sesi_id',
        'id_kategori',
        'jarak_pilihan',
        'anggaran_pilihan',
        'jumlah_hasil',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}
