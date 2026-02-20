# Panduan Integrasi Flux Pro
@Futoruu - https://shopee.co.id/futoruu

## Intro
Halo Pembeli Setia @Futoruu 👋 Panduan ini bakal nuntun kalian pasang `flux-pro` di project Laravel kalian.

## Yang Perlu Disiapin
- Project Laravel yang udah Jadi (wajib!)
! Keadaan Disini Project Livewire nya sudah digunakan seperti starter kit laravel livewire pada umumnya

## Step-By-Stepnya
Cek isi folder FluxPro sesuai versi yang kk mau install contoh ( FluxPro [ Update v2.2.3 ] )
1. Tambahkan version di file `composer.json` :
   
   {
       "name": "livewire/flux-pro",
        "description": "The pro version of Flux, the official UI component library for Livewire.",
        "keywords": ["flux", "laravel", "livewire", "components", "ui"],
        "version": "2.2.3", #Tambahkan Baris ini dan sesuaikan versinya
        "license": "proprietary",
       ....
   }

2. Zip semua file dan beri nama arsip sesuai versi juga `flux-pro-2.2.3.zip`
   (!) Pastikan untuk men-zip folder `src/`, `dist/`, `stubs/`, dan file `composer.json` langsung tanpa folder root.

3. Sekarang di dalam project Laravel-mu, buat folder `packages/` dan salin file `flux-pro-2.2.3.zip` ke dalamnya.
4. Update file `composer.json` di project Laravel kamu dengan mendaftarkan repositori zip lokal:
  ```
   "repositories": {
           "type": "artifact",
           "url": "./packages"
    },
  ```
5. Jalankan `composer require livewire/flux-pro` untuk menginstal
6. Jalankan `composer dump-autoload` untuk check flux-pro sudah include

## Disini Seharusnya sudah cukup & tinggal lanjutkan project kamu menggunakan flux-pro
seperti mulai menggunakan @fluxAppearance and @fluxScripts di layout file


========================================================
========================================================
========================================================
## Langkah Update [Kalau ada Versi Terbaru]
1. Jalankan `composer remove livewire/flux-pro`
2. Hapus file zip flux-pro di folder packages

3. Jalankan
composer clear-cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

4. Download flux-pro update versi terbaru yang saya kasih
5. Ulangi langkah ## Step-By-Stepnya di paling awal installasi tetapi hanya langkah 1,2,3
6. Jalankan `composer require livewire/flux-pro`
   Kalau muncul error `Installation failed, reverting ./composer.json and ./composer.lock to their original content.`
   Jalankan `composer require livewire/flux-pro:2.2.3 livewire/flux:2.2.3 -W` 
   [ jika ada update kedepannya tinggal ganti versinya saja sesuai versi update yang diberikan ]
   [ contoh `livewire/flux-pro:9.9.9 livewire/flux:9.9.9 -W` ]

7. Jalankan `composer update livewire/flux livewire/flux-pro`
8. Seperti biasa
   `php artisan config:clear`
   `php artisan cache:clear`
   `php artisan view:clear`


========================================================
========================================================
========================================================
## Bagi Pelanggan Yang Telah Melakukan Panduan Integrasi Flux Pro 1.1.4 dan ingin update ke versi terbaru ke v2
1. Hapus ini 
     ```
     "autoload": {
         "psr-4": {
             "App\\": "app/",
             "FluxPro\\": "./packages/flux-pro/src/" <--- HAPUS INI
         }
     }
    ```
2. Hapus juga settingan service provider `app/Providers/AppServiceProvider.php` sebelumnya, biar kembali normal
     ```
     public function register(): void
     {
         $this->app->register(\FluxPro\FluxProServiceProvider::class); <--- HAPUS INI
     }
     ```
3. file composer.json sebelumnya
    `require`: "livewire/flux-pro": <--- HAPUS INI 
    `"minimum-stability": "dev"` <--- ganti dev jadi stable

4. Tinggal ikutin langkah ## Langkah Update


========================================================
========================================================
========================================================

### Kalau terjadi error locate class / view component 
Jalankan `composer update livewire/flux livewire/flux-pro`

### Kalau terjadi error css / warna jadi aneh
Jalankan
`php artisan view:clear`
`php artisan cache:clear`
`php artisan config:clear`

### Command yang sering dipakai
composer update
npm run build
npm run dev
php artisan migrate
php artisan serve

**Publish Seluruh Komponen**
    offical Docs : https://fluxui.dev/docs/customization
    ```bash
    php artisan flux:publish --all
    ```

**Permasalahan-Permasalahan Yang Muncul saat devlopment di project kamu**
- fungsi komponen kadang jalan kadang engga [ https://github.com/livewire/flux/issues/1565 ]
- Jangan Lupa kalau ada Fungsi lain di komponen yang kk paste dari website
  Contoh wire:model maka buat dulu property nya sesuai code yg ada disitu
  contoh lagi : wire:model="categories" memerlukan property $categories di Livewire component dll
  
============= @Futoruu - https://shopee.co.id/futoruu ================ @Futoruu - https://shopee.co.id/futoruu ================