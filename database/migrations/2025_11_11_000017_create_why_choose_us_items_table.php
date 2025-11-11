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
        Schema::create('why_choose_us_items', function (Blueprint $table) {
            $table->id();
            $table->string('title_tr')->nullable();
            $table->string('title_en')->nullable();
            $table->text('description_tr')->nullable();
            $table->text('description_en')->nullable();
            $table->string('icon')->default('building');
            $table->integer('order')->default(0);
            $table->enum('status', ['active', 'passive'])->default('active');
            $table->timestamps();
        });

        $now = now();

        DB::table('why_choose_us_items')->insert([
            [
                'title_tr' => '15 Yıllık Havuz Hizmeti',
                'title_en' => '15 Years of Pool Service',
                'description_tr' => 'Onlarca projenin kazandırdığı uzmanlık ve güven.',
                'description_en' => 'Expertise and trust built over dozens of projects.',
                'icon' => 'building',
                'order' => 1,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title_tr' => 'Kalite Garantisi',
                'title_en' => 'Quality Guarantee',
                'description_tr' => 'Haftalık havuz bakım müşterilerimiz "su kalitesi garantisi" alır, hemen kaydolun.',
                'description_en' => 'Our weekly pool maintenance customers get our water quality guarantee.',
                'icon' => 'shield-check',
                'order' => 2,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title_tr' => 'Deneyimli Teknisyenler',
                'title_en' => 'Experienced Technicians',
                'description_tr' => 'Olağanüstü hizmet sunmaya adanmış yüksek vasıflı teknisyenler.',
                'description_en' => 'Highly skilled technicians dedicated to exceptional service.',
                'icon' => 'users',
                'order' => 3,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title_tr' => 'Uzman Havuz Onarımı',
                'title_en' => 'Expert Pool Repairs',
                'description_tr' => 'Tüm havuz ekipmanları ve aksesuarları için onarım hizmetleri sunuyoruz.',
                'description_en' => 'Repair services for all pool equipment and accessories.',
                'icon' => 'cog',
                'order' => 4,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title_tr' => 'Tam Temizlik Sözü',
                'title_en' => 'Total Clean Promise',
                'description_tr' => '"Nokta Temizlik" bazı havuz hizmet şirketlerinin fiyatları düşürmek için kullandığı kötü bir uygulamadır.',
                'description_en' => '"Spot Cleaning" is a bad practice some pool service companies use to cut prices.',
                'icon' => 'sparkles',
                'order' => 5,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title_tr' => 'Teklif Talebi',
                'title_en' => 'Request an Estimate',
                'description_tr' => 'Havuz bakımı, havuz onarımı veya havuz yenileme için fiyat teklifi alın.',
                'description_en' => 'Get a quote for maintenance, repair, or renovation.',
                'icon' => 'document',
                'order' => 6,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_choose_us_items');
    }
};

