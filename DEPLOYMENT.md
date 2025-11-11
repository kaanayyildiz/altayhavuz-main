# Deployment Rehberi

## Hosting'e Deploy Etme

### Önemli: Resimlerin Görünmesi İçin

Bu projede resimler `storage/app/public` klasöründe tutulmaktadır. Resimlerin görünmesi için **mutlaka** aşağıdaki komutu çalıştırmanız gerekir:

```bash
php artisan storage:link
```

Bu komut `public/storage` klasörünü `storage/app/public` klasörüne sembolik link (symlink) olarak bağlar.

### Otomatik Deployment

`deploy.sh` script'ini kullanarak otomatik deployment yapabilirsiniz:

```bash
chmod +x deploy.sh
./deploy.sh
```

### Manuel Deployment Adımları

1. **Projeyi hosting'e yükleyin**
   ```bash
   git pull origin main
   # veya
   # Dosyaları FTP/SFTP ile yükleyin
   ```

2. **Composer bağımlılıklarını yükleyin**
   ```bash
   composer install --no-dev --optimize-autoloader
   ```

3. **Environment dosyasını ayarlayın**
   - `.env` dosyasını oluşturun veya düzenleyin
   - Veritabanı, mail, vb. ayarları yapın

4. **Cache'leri temizleyin**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```

5. **Production cache'lerini oluşturun**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

6. **Migration'ları çalıştırın**
   ```bash
   php artisan migrate --force
   ```

7. **⚠️ STORAGE LINK'İNİ OLUŞTURUN (ÇOK ÖNEMLİ!)**
   ```bash
   php artisan storage:link
   ```
   Bu komut olmadan resimler görünmez!

8. **İzinleri ayarlayın**
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

### Sorun Giderme

#### Resimler görünmüyor

1. Storage link'inin oluşturulduğunu kontrol edin:
   ```bash
   ls -la public/storage
   ```
   Eğer `public/storage` bir link ise (ok işareti ile gösterilir), link doğru oluşturulmuştur.

2. Eğer link yoksa, tekrar oluşturun:
   ```bash
   php artisan storage:link
   ```

3. Eğer link zaten varsa ama çalışmıyorsa, önce silin sonra tekrar oluşturun:
   ```bash
   rm public/storage
   php artisan storage:link
   ```

4. Storage klasörüne yazma izni verildiğinden emin olun:
   ```bash
   chmod -R 775 storage
   ```

#### Permission denied hatası

Storage ve cache klasörlerine yazma izni verin:
```bash
chmod -R 775 storage bootstrap/cache
```

#### Composer hatası

Composer'ın güncel olduğundan emin olun:
```bash
composer self-update
```

### Notlar

- `storage/app/public` klasöründeki dosyalar git'e dahil edilmez (`.gitignore` içinde)
- Yüklenen resimler bu klasörde tutulur
- `public/storage` sadece bir sembolik linktir, git'e dahil edilmez
- Her deployment sonrası `php artisan storage:link` komutunu çalıştırmayı unutmayın!

