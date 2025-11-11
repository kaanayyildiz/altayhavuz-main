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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title_tr')->nullable();
            $table->string('title_en')->nullable();
            $table->text('description_tr')->nullable();
            $table->text('description_en')->nullable();
            $table->text('features_tr')->nullable();
            $table->text('features_en')->nullable();
            $table->string('icon')->default('heart');
            $table->integer('order')->default(0);
            $table->enum('status', ['active', 'passive'])->default('active');
            $table->timestamps();
        });

        DB::table('services')->insert([
            [
                'title_tr' => 'Havuz Tasarımı',
                'title_en' => 'Pool Design',
                'description_tr' => 'İsteklerinize göre profesyonel havuz tasarımı ve danışmanlık hizmetleri sunuyoruz.',
                'description_en' => 'We provide professional pool design and consulting tailored to your needs.',
                'features_tr' => "3D Tasarım ve Görselleştirme\nÖzel Tasarım Çözümleri\nMalzeme Seçimi Danışmanlığı",
                'features_en' => "3D Design and Visualization\nCustom Design Solutions\nMaterial Selection Consulting",
                'icon' => 'heart',
                'order' => 1,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_tr' => 'Havuz İnşaatı',
                'title_en' => 'Pool Construction',
                'description_tr' => 'Modern teknikler ile betonerme ve fiberglas havuz yapımında uzman ekibimizle yanınızdayız.',
                'description_en' => 'Our expert team builds reinforced concrete and fiberglass pools using modern techniques.',
                'features_tr' => "Betonarme Havuz İnşaatı\nFiberglas Havuz Kurulumu\nHavuz Ekipmanları Kurulumu",
                'features_en' => "Reinforced Concrete Pool Construction\nFiberglass Pool Installation\nPool Equipment Installation",
                'icon' => 'building',
                'order' => 2,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_tr' => 'Havuz Bakımı',
                'title_en' => 'Pool Maintenance',
                'description_tr' => 'Düzenli bakım, kimyasal denge kontrolü ve ekipman bakımı ile havuzunuz hep hazır.',
                'description_en' => 'Keep your pool ready with regular maintenance, chemical balance checks, and equipment care.',
                'features_tr' => "Haftalık Bakım Programı\nKimyasal Denge Kontrolü\nEkipman Bakım ve Onarım",
                'features_en' => "Weekly Maintenance Schedule\nChemical Balance Control\nEquipment Maintenance and Repair",
                'icon' => 'settings',
                'order' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title_tr' => 'Havuz Yenileme',
                'title_en' => 'Pool Renovation',
                'description_tr' => 'Mevcut havuzlarınız için yenileme, modernizasyon ve yapısal güçlendirme çözümleri sunuyoruz.',
                'description_en' => 'We offer renovation, modernization, and structural reinforcement solutions for existing pools.',
                'features_tr' => "Fayans ve Kaplama Yenileme\nEkipman Modernizasyonu\nYapısal Güçlendirme",
                'features_en' => "Tile and Coating Renewal\nEquipment Modernization\nStructural Reinforcement",
                'icon' => 'refresh',
                'order' => 4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

