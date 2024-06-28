<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menu_functions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('icon');
            $table->string('route');
            $table->string('mmodules_id');
            $table->integer('sort');
            $table->string('type');
            $table->string('access');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_functions');
    }
};
