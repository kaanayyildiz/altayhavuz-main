#!/bin/bash

# Laravel Deployment Script
# Bu script hosting'e deploy ederken çalıştırılmalıdır

echo "🚀 Laravel Deployment başlatılıyor..."

# Composer bağımlılıklarını yükle
echo "📦 Composer bağımlılıkları yükleniyor..."
composer install --no-dev --optimize-autoloader

# Environment dosyasını kontrol et
if [ ! -f .env ]; then
    echo "⚠️  .env dosyası bulunamadı! Lütfen .env dosyasını oluşturun."
    exit 1
fi

# Cache'leri temizle
echo "🧹 Cache'ler temizleniyor..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Config ve route cache'lerini oluştur (production için)
echo "⚡ Production cache'leri oluşturuluyor..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Migration'ları çalıştır
echo "🗄️  Veritabanı migration'ları çalıştırılıyor..."
php artisan migrate --force

# Storage link'ini oluştur (ÖNEMLİ: Resimlerin görünmesi için gerekli)
echo "🔗 Storage link oluşturuluyor..."
php artisan storage:link

# Storage klasörüne yazma izni ver
echo "📝 Storage klasörüne yazma izni veriliyor..."
chmod -R 775 storage
chmod -R 775 bootstrap/cache

echo "✅ Deployment tamamlandı!"
echo ""
echo "⚠️  ÖNEMLİ NOTLAR:"
echo "1. .env dosyasının doğru yapılandırıldığından emin olun"
echo "2. Veritabanı bağlantısının çalıştığından emin olun"
echo "3. Storage link'inin oluşturulduğunu kontrol edin: ls -la public/storage"
echo "4. Storage klasörüne yazma izni verildiğinden emin olun"

