<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin kullanıcısı oluştur veya güncelle
        User::updateOrCreate(
            ['email' => 'admin@altayhavuz.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        $this->command->info('Admin kullanıcısı oluşturuldu!');
        $this->command->info('Email: admin@altayhavuz.com');
        $this->command->info('Şifre: admin123');
    }
}



