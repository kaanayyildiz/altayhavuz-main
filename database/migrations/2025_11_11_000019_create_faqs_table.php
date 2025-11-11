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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question_tr');
            $table->string('question_en')->nullable();
            $table->text('answer_tr')->nullable();
            $table->text('answer_en')->nullable();
            $table->integer('order')->default(0);
            $table->enum('status', ['active', 'passive'])->default('active');
            $table->timestamps();
        });

        $now = now();

        DB::table('faqs')->insert([
            [
                'question_tr' => 'Havuzuma ne gibi değişiklikler yapabilirim?',
                'question_en' => 'What changes can I make to my pool?',
                'answer_tr' => 'Su özellikleri ekleyebilir veya çıkarabiliriz. Güneşlenme bölgesi, plaj girişi ekleyebilir veya havuzun derinliğini bile değiştirebiliriz.',
                'answer_en' => 'We can add or remove water features, tanning ledges, beach entries, or even change the depth.',
                'order' => 1,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_tr' => 'Garanti hizmetiniz var mı?',
                'question_en' => 'Do you offer warranty service?',
                'answer_tr' => 'Evet, tüm havuz inşaat ve onarım işlerimiz için garanti hizmetleri sunuyoruz.',
                'answer_en' => 'Yes, we provide warranty services for all pool construction and repair work.',
                'order' => 2,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_tr' => 'Kendi parçalarımı sağlayabilir miyim?',
                'question_en' => 'Can I supply my own parts?',
                'answer_tr' => 'Elbette, ancak en iyi performans için sertifikalı parçalarımızı öneririz.',
                'answer_en' => 'You can, but we recommend our certified parts for the best performance.',
                'order' => 3,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_tr' => 'Servis çağrısı için evde olmam gerekiyor mu?',
                'question_en' => 'Do I need to be home for a service call?',
                'answer_tr' => 'Hayır, önceden düzenleme ile ekibimiz havuz alanınıza erişebilir.',
                'answer_en' => 'No, our team can access your pool area with prior arrangement.',
                'order' => 4,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_tr' => 'Hafta sonu servisiniz var mı?',
                'question_en' => 'Do you offer weekend service?',
                'answer_tr' => 'Evet, acil durumlar için hafta sonu servis hizmeti sunuyoruz.',
                'answer_en' => 'Yes, we provide weekend service for urgent needs.',
                'order' => 5,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'question_tr' => 'Finansman seçenekleriniz mevcut mu?',
                'question_en' => 'Is financing available?',
                'answer_tr' => 'Evet, büyük onarımlar ve yenilemeler için esnek finansman seçeneklerimiz mevcut.',
                'answer_en' => 'Yes, we offer flexible financing options for major repairs and renovations.',
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
        Schema::dropIfExists('faqs');
    }
};

