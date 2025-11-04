<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->foreignId('portfolio_category_id')->nullable()->after('image_path')->constrained('portfolio_categories')->nullOnDelete();
            $table->dropColumn('type');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->enum('type', ['open', 'closed'])->default('open');
            $table->dropConstrainedForeignId('portfolio_category_id');
        });
    }
};


