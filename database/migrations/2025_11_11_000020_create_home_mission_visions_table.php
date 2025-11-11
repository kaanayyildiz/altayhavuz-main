<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('home_mission_visions', function (Blueprint $table) {
            $table->id();
            $table->string('tagline_tr')->nullable();
            $table->string('tagline_en')->nullable();
            $table->string('mission_title_tr')->nullable();
            $table->string('mission_title_en')->nullable();
            $table->text('mission_description_tr')->nullable();
            $table->text('mission_description_en')->nullable();
            $table->string('vision_title_tr')->nullable();
            $table->string('vision_title_en')->nullable();
            $table->text('vision_description_tr')->nullable();
            $table->text('vision_description_en')->nullable();
            $table->timestamps();
        });

        DB::table('home_mission_visions')->insert([
            'id' => 1,
            'tagline_tr' => 'Müşterilerimizi anlamak',
            'tagline_en' => 'Understanding our customers',
            'mission_title_tr' => 'Misyon Bildirgesi',
            'mission_title_en' => 'Mission Statement',
            'mission_description_tr' => 'Makul bir fiyatla yüksek değerli hizmet sunuyoruz ve iş taahhütlerimize bağlı kalarak müşterilerimizin beklentilerinin ötesine geçiyoruz.',
            'mission_description_en' => 'We provide a high-value service at a reasonable price and go beyond our customers\' expectations.',
            'vision_title_tr' => 'Vizyon Bildirgesi',
            'vision_title_en' => 'Vision Statement',
            'vision_description_tr' => 'Uzun vadeli taahhütlere inanıyoruz ve müşterilerimizle sürdürülebilir ilişkiler kuruyoruz.',
            'vision_description_en' => 'We believe in long-term commitments and foster lasting relationships with our customers.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_mission_visions');
    }
};

