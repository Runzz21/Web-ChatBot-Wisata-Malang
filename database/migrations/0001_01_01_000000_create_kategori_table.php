<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('kategori')) {
            Schema::create('kategori', function (Blueprint $table) {
                $table->tinyInteger('id_kategori', true, true);
                $table->string('nama_kategori', 100);
                $table->string('slug', 150)->unique();
                $table->string('warna_badge', 20)->nullable();
                $table->string('icon', 50)->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('kategori');
    }
};
