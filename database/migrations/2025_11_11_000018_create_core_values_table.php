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
        Schema::create('core_values', function (Blueprint $table) {
            $table->id();
            $table->text('text_tr')->nullable();
            $table->text('text_en')->nullable();
            $table->integer('order')->default(0);
            $table->enum('status', ['active', 'passive'])->default('active');
            $table->timestamps();
        });

        $now = now();

        DB::table('core_values')->insert([
            [
                'text_tr' => 'Günlük yaşamlarında yüksek ahlaka sahip bireyleri çekmeye çalışıyoruz.',
                'text_en' => 'We strive to attract individuals that have high morals in their everyday lives.',
                'order' => 1,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'text_tr' => 'Yüksek hizmet işindeyiz ve bu nedenle mümkün olan en iyi profesyonelleri işe alıyor ve eğitiyoruz.',
                'text_en' => 'We are in a high service business and hire and train the best professionals.',
                'order' => 2,
                'status' => 'active',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'text_tr' => 'Yüksek kalite standartlarımızı korumak için çalışanlarımızı eğitiyor, motive ediyor ve güçlendiriyoruz.',
                'text_en' => 'We educate, motivate, and empower our people to maintain our high quality standards.',
                'order' => 3,
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
        Schema::dropIfExists('core_values');
    }
};

