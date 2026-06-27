<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('chatbot_log')) {
            Schema::create('chatbot_log', function (Blueprint $table) {
                $table->mediumInteger('id_log', true, true);
                $table->string('sesi_id', 100);
                $table->tinyInteger('id_kategori')->unsigned()->nullable();
                $table->string('jarak_pilihan', 20)->nullable();
                $table->string('anggaran_pilihan', 20)->nullable();
                $table->tinyInteger('jumlah_hasil')->default(0);
                $table->timestamp('dibuat_pada')->useCurrent();

                $table->foreign('id_kategori')
                    ->references('id_kategori')
                    ->on('kategori')
                    ->onDelete('set null');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('chatbot_log');
    }
};
