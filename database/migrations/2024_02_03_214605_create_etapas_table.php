<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('etapas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_proyecto');
            $table->integer('id_cat_etapa');
            $table->integer('id_doc');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('etapas');
    }
};
