<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('admin')) {
            Schema::create('admin', function (Blueprint $table) {
                $table->tinyInteger('id_admin', true, true);
                $table->string('username', 50)->unique();
                $table->string('password_hash', 255);
                $table->timestamp('dibuat_pada')->useCurrent();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('admin');
    }
};
