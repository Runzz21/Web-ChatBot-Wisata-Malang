<?php

namespace App\Http\Controllers;

use App\Models\ChatbotLog;
use App\Models\Destinasi;
use App\Models\Kategori;

class TentangController extends Controller
{
    public function index()
    {
        $totalDestinasi = Destinasi::aktif()->count();
        $totalKategori = Kategori::count();
        $totalKunjungan = ChatbotLog::count();

        return view('tentang.index', compact(
            'totalDestinasi',
            'totalKategori',
            'totalKunjungan'
        ));
    }
}
