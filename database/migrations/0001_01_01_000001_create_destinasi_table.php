<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('destinasi')) {
            Schema::create('destinasi', function (Blueprint $table) {
                $table->smallInteger('id_destinasi', true, true);
                $table->string('nama', 200);
                $table->tinyInteger('id_kategori')->unsigned();
                $table->string('lokasi', 255);
                $table->integer('ketinggian_mdpl')->nullable();
                $table->decimal('jarak_km', 8, 2)->nullable();
                $table->decimal('harga_tiket', 12, 2)->default(0);
                $table->time('jam_buka')->nullable();
                $table->time('jam_tutup')->nullable();
                $table->boolean('buka_24jam')->default(false);
                $table->text('deskripsi')->nullable();
                $table->string('foto_utama', 255)->nullable();
                $table->string('fasilitas', 500)->nullable();
                $table->boolean('status_aktif')->default(true);
                $table->timestamp('dibuat_pada')->useCurrent();

                $table->foreign('id_kategori')
                    ->references('id_kategori')
                    ->on('kategori')
                    ->onDelete('restrict');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('destinasi');
    }
};
