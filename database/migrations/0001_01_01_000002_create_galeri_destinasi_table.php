<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('galeri_destinasi')) {
            Schema::create('galeri_destinasi', function (Blueprint $table) {
                $table->smallInteger('id_galeri', true, true);
                $table->smallInteger('id_destinasi')->unsigned();
                $table->string('url_foto', 255);
                $table->tinyInteger('urutan')->default(0);

                $table->foreign('id_destinasi')
                    ->references('id_destinasi')
                    ->on('destinasi')
                    ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_destinasi');
    }
};
