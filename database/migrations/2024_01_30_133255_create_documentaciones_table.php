<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documentaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('id_proyecto');
            $table->string('nombre');
            $table->string('directorio')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documentaciones');
    }
};
