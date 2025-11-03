<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title_tr')->nullable();
            $table->string('title_en')->nullable();
            $table->string('image_path');
            $table->enum('type', ['open', 'closed'])->default('open');
            $table->unsignedInteger('order')->default(0);
            $table->enum('status', ['active', 'passive'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};





