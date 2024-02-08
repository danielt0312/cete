<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('desarrolladores', function (Blueprint $table) {
            $table->id();
            $table->integer('id_proceso');
            $table->integer('id_cat_desarrollador');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desarrolladores');
    }
};
