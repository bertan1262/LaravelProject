<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        // Admin kullanıcı
        $user = User::firstOrCreate(
            ['email' => 'bertan@gmail.com'],
            ['name' => 'Bertan', 'password' => bcrypt('bertan')]
        );

        // Kategoriler
        Category::truncate();

        $elek  = Category::create(['name' => 'Elektronik',  'parent_id' => null]);
        $tel   = Category::create(['name' => 'Telefon',     'parent_id' => $elek->id]);
        $bil   = Category::create(['name' => 'Bilgisayar',  'parent_id' => $elek->id]);
        $giy   = Category::create(['name' => 'Giyim',       'parent_id' => null]);
        $erk   = Category::create(['name' => 'Erkek',       'parent_id' => $giy->id]);
        $kadin = Category::create(['name' => 'Kadın',       'parent_id' => $giy->id]);
        $ev    = Category::create(['name' => 'Ev & Yaşam',  'parent_id' => null]);
        $kit   = Category::create(['name' => 'Kitap',       'parent_id' => null]);

        // Ürünler
        Product::truncate();

        $products = [
            // Telefon
            [
                'category_id' => $tel->id, 'user_id' => $user->id,
                'title'       => 'iPhone 15 Pro 256GB',
                'keywords'    => 'iphone, apple, telefon, akıllı telefon',
                'description' => 'Apple\'ın en yeni amiral gemisi akıllı telefonu.',
                'detail'      => '<p><strong>A17 Pro</strong> çip ile güçlü performans. 48MP kamera sistemi, titanyum kasa ve USB-C bağlantısı.</p><ul><li>6.1 inç Super Retina XDR</li><li>48MP Ana Kamera</li><li>Titanyum Tasarım</li><li>USB-C 3.0</li></ul>',
                'price'       => 54999, 'stock' => 25, 'minstock' => 5, 'discount' => 0, 'status' => 1,
                'image'       => 'products/iphone_15_pro.png',
            ],
            [
                'category_id' => $tel->id, 'user_id' => $user->id,
                'title'       => 'Samsung Galaxy S24 Ultra',
                'keywords'    => 'samsung, galaxy, s24, s pen',
                'description' => 'S Pen destekli güçlü Android amiral gemisi.',
                'detail'      => '<p>200MP kamera, entegre <strong>S Pen</strong>, 5000mAh batarya. Yapay zeka özellikleri ile donatılmış.</p><ul><li>6.8 inç QHD+ Dynamic AMOLED</li><li>200MP Kamera</li><li>S Pen dahil</li><li>Snapdragon 8 Gen 3</li></ul>',
                'price'       => 49999, 'stock' => 18, 'minstock' => 3, 'discount' => 10, 'status' => 1,
                'image'       => 'products/samsung_s24_ultra.png',
            ],
            [
                'category_id' => $tel->id, 'user_id' => $user->id,
                'title'       => 'Xiaomi 14 Pro 512GB',
                'keywords'    => 'xiaomi, leica, kamera telefon',
                'description' => 'Leica iş birliğiyle geliştirilen fotoğraf canavarı.',
                'detail'      => '<p>Leica ortaklıklı profesyonel kamera sistemi, 120W HyperCharge ile 15 dakikada tam şarj.</p><ul><li>50MP Leica Kamera</li><li>120W Hızlı Şarj</li><li>Snapdragon 8 Gen 3</li><li>IP68 Su Geçirmezlik</li></ul>',
                'price'       => 32999, 'stock' => 40, 'minstock' => 5, 'discount' => 5, 'status' => 1,
                'image'       => 'products/xiaomi_14_pro.png',
            ],
            [
                'category_id' => $tel->id, 'user_id' => $user->id,
                'title'       => 'Google Pixel 9 Pro XL',
                'keywords'    => 'google, pixel, android saf',
                'description' => 'Android\'i en saf haliyle yaşa, 7 yıl güncelleme garantisi.',
                'detail'      => '<p>Google Tensor G4 çip, yapay zeka destekli fotoğraf düzenleme, 7 yıl güvenlik güncellemesi garantisi.</p>',
                'price'       => 39999, 'stock' => 3, 'minstock' => 5, 'discount' => 0, 'status' => 1,
                'image'       => 'products/google_pixel_9.png',
            ],

            // Bilgisayar
            [
                'category_id' => $bil->id, 'user_id' => $user->id,
                'title'       => 'Apple MacBook Air M3 16GB',
                'keywords'    => 'macbook, apple, laptop, m3',
                'description' => 'Fansız tasarım, 18 saat pil ömrü, inanılmaz performans.',
                'detail'      => '<p>Apple <strong>M3</strong> çip, 18 saat pil ömrü, sadece 1.24kg ağırlık. Hem iş hem yaratıcı çalışmalar için mükemmel.</p><ul><li>Apple M3 Çip (8 çekirdek CPU)</li><li>16GB Birleşik Bellek</li><li>256GB SSD</li><li>15.3" Liquid Retina</li><li>18 saat pil</li></ul>',
                'price'       => 62999, 'stock' => 12, 'minstock' => 2, 'discount' => 0, 'status' => 1,
                'image'       => 'products/macbook_air_m3.png',
            ],
            [
                'category_id' => $bil->id, 'user_id' => $user->id,
                'title'       => 'Asus ROG Strix G18 Gaming',
                'keywords'    => 'asus, rog, gaming, rtx 4080, oyuncu laptop',
                'description' => 'RTX 4080 ile en zorlu oyunları maksimum ayarda oyna.',
                'detail'      => '<p>Intel Core i9-14900HX, NVIDIA <strong>RTX 4080</strong>, 240Hz 2K QHD ekran. Oyun dünyasının zirvesi.</p><ul><li>Intel i9-14900HX</li><li>RTX 4080 12GB GDDR6</li><li>32GB DDR5</li><li>18" QHD 240Hz</li><li>1TB NVMe SSD</li></ul>',
                'price'       => 89999, 'stock' => 8, 'minstock' => 2, 'discount' => 8, 'status' => 1,
                'image'       => 'products/product_asus-rog-strix-g18-gaming_1780159854.jpg',
            ],
            [
                'category_id' => $bil->id, 'user_id' => $user->id,
                'title'       => 'Dell XPS 15 OLED 2024',
                'keywords'    => 'dell, xps, oled, ultrabook',
                'description' => 'Profesyonel kullanım için OLED ekranlı ince ve şık laptop.',
                'detail'      => '<p>3.5K OLED ekran, Intel Core Ultra 7, 32GB RAM. Tasarımcılar ve profesyoneller için ideal.</p><ul><li>Intel Core Ultra 7</li><li>NVIDIA RTX 4060</li><li>32GB DDR5</li><li>15.6" 3.5K OLED</li></ul>',
                'price'       => 55999, 'stock' => 15, 'minstock' => 3, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_dell-xps-15-oled-2024_1780159855.jpg',
            ],

            // Erkek Giyim
            [
                'category_id' => $erk->id, 'user_id' => $user->id,
                'title'       => 'Slim Fit Takım Elbise - Lacivert',
                'keywords'    => 'takım elbise, erkek, slim fit, lacivert',
                'description' => 'İş toplantıları ve özel günler için şık slim fit takım.',
                'detail'      => '<p>%65 Polyester, %35 Yün karışım, slim fit kesim. Kuru temizleme önerilir.</p><ul><li>Slim fit kesim</li><li>4 renk seçeneği</li><li>İç astar mevcuttur</li><li>Beden: 46-60</li></ul>',
                'price'       => 2999, 'stock' => 50, 'minstock' => 10, 'discount' => 15, 'status' => 1,
                'image'       => 'products/product_slim-fit-takim-elbise-lacivert_1780159856.jpg',
            ],
            [
                'category_id' => $erk->id, 'user_id' => $user->id,
                'title'       => 'Premium Hakiki Deri Kemer',
                'keywords'    => 'kemer, deri, erkek, hakiki deri',
                'description' => 'Hakiki inek derisinden üretilmiş şık erkek kemeri.',
                'detail'      => '<p>%100 hakiki inek derisi, paslanmaz çelik toka. 90-130cm arası beden uyumu.</p>',
                'price'       => 399, 'stock' => 80, 'minstock' => 20, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_premium-hakiki-deri-kemer_1780159857.jpg',
            ],
            [
                'category_id' => $erk->id, 'user_id' => $user->id,
                'title'       => 'Basic Oversize Tişört 3\'lü Paket',
                'keywords'    => 'tişört, oversize, erkek, basic',
                'description' => 'Günlük kullanım için %100 pamuklu oversize tişört.',
                'detail'      => '<p>%100 combed pamuk, 180gsm kumaş. Beyaz, siyah, gri renk kombinasyonu.</p><ul><li>3 adet farklı renk</li><li>%100 Combed Pamuk</li><li>S - 4XL beden aralığı</li></ul>',
                'price'       => 449, 'stock' => 120, 'minstock' => 20, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_basic-oversize-tisort-3lu-paket_1780159858.jpg',
            ],

            // Kadın Giyim
            [
                'category_id' => $kadin->id, 'user_id' => $user->id,
                'title'       => 'Şifon Yazlık Çiçekli Elbise',
                'keywords'    => 'elbise, yazlık, şifon, çiçek, kadın',
                'description' => 'Hafif şifon kumaştan, yaz ayları için şık elbise.',
                'detail'      => '<p>%100 şifon kumaş, çiçek desenli, midi boy. 3 renk seçeneği: Pembe, Mavi, Sarı.</p><ul><li>Midi boy</li><li>3 renk seçeneği</li><li>XS - XXL beden</li></ul>',
                'price'       => 899, 'stock' => 60, 'minstock' => 10, 'discount' => 20, 'status' => 1,
                'image'       => 'products/product_sifon-yazlik-cicekli-elbise_1780159859.jpg',
            ],
            [
                'category_id' => $kadin->id, 'user_id' => $user->id,
                'title'       => 'Beyaz Sneaker Spor Ayakkabı',
                'keywords'    => 'sneaker, spor ayakkabı, kadın, beyaz',
                'description' => 'Her kombine uyumlu, konforlu günlük sneaker.',
                'detail'      => '<p>Hafif kauçuk taban, nefes alan mesh üst, şok emici iç taban.</p><ul><li>36-41 numara</li><li>Beyaz / Pudra renk</li><li>Bağcıklı model</li></ul>',
                'price'       => 1299, 'stock' => 45, 'minstock' => 8, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_beyaz-sneaker-spor-ayakkabi_1780159860.jpg',
            ],

            // Ev & Yaşam
            [
                'category_id' => $ev->id, 'user_id' => $user->id,
                'title'       => 'Philips Airfryer HD9270 6.2L',
                'keywords'    => 'airfryer, philips, yağsız pişirme, fırın',
                'description' => '%90 daha az yağ ile sağlıklı ve lezzetli yemekler.',
                'detail'      => '<p>6.2 litre kapasiteli, 13 otomatik pişirme programı, dijital dokunmatik panel. Aile boyutu için ideal.</p><ul><li>6.2L Kapasite</li><li>13 Pişirme Programı</li><li>Bulaşık makinesinde yıkanabilir</li><li>2000W güç</li></ul>',
                'price'       => 3499, 'stock' => 30, 'minstock' => 5, 'discount' => 12, 'status' => 1,
                'image'       => 'products/product_philips-airfryer-hd9270-62l_1780159861.jpg',
            ],
            [
                'category_id' => $ev->id, 'user_id' => $user->id,
                'title'       => 'Dyson V15 Detect Kablosuz Süpürge',
                'keywords'    => 'dyson, süpürge, kablosuz, lazer',
                'description' => 'Lazer teknolojisiyle görünmez tozu bile tespit eder.',
                'detail'      => '<p>Lazer toz tespiti, tam kapalı HEPA filtre sistemi, 60 dakika pil ömrü.</p><ul><li>240 AW emme gücü</li><li>Lazer Slim Fluffy başlık</li><li>60 dakika pil</li><li>HEPA Filtre</li></ul>',
                'price'       => 18999, 'stock' => 10, 'minstock' => 2, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_dyson-v15-detect-kablosuz-supurge_1780159862.jpg',
            ],
            [
                'category_id' => $ev->id, 'user_id' => $user->id,
                'title'       => 'Nespresso Vertuo Pop Kahve Makinesi',
                'keywords'    => 'nespresso, kahve makinesi, kapsül, vertuo',
                'description' => 'Kapsül sistemiyle barista kalitesinde kahve.',
                'detail'      => '<p>Centrifusion teknolojisi, 5 fincan boyutu, 30 saniyede hazır.</p>',
                'price'       => 2999, 'stock' => 25, 'minstock' => 5, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_nespresso-vertuo-pop-kahve-makinesi_1780159864.jpg',
            ],

            // Kitap
            [
                'category_id' => $kit->id, 'user_id' => $user->id,
                'title'       => 'Atomic Habits — James Clear',
                'keywords'    => 'kitap, alışkanlık, james clear, kişisel gelişim',
                'description' => 'Küçük alışkanlıklar büyük sonuçlar doğurur.',
                'detail'      => '<p>James Clear\'ın dünya genelinde <strong>15 milyonun üzerinde</strong> satmış başyapıtı. Alışkanlıklarını nasıl değiştirebileceğini bilimsel verilerle anlatıyor.</p>',
                'price'       => 129, 'stock' => 200, 'minstock' => 20, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_atomic-habits-james-clear_1780159866.jpg',
            ],
            [
                'category_id' => $kit->id, 'user_id' => $user->id,
                'title'       => 'Sapiens — Yuval Noah Harari',
                'keywords'    => 'kitap, tarih, sapiens, harari, insanlık',
                'description' => 'İnsanlığın 70.000 yıllık kısa bir tarihi.',
                'detail'      => '<p>Yuval Noah Harari\'nin çok satan eseri. İnsanlık tarihini farklı bir perspektiften ele alıyor.</p>',
                'price'       => 149, 'stock' => 150, 'minstock' => 15, 'discount' => 5, 'status' => 1,
                'image'       => 'products/product_sapiens-yuval-noah-harari_1780159867.jpg',
            ],
            [
                'category_id' => $kit->id, 'user_id' => $user->id,
                'title'       => 'Dune — Frank Herbert',
                'keywords'    => 'kitap, dune, sci-fi, bilim kurgu, frank herbert',
                'description' => 'Tüm zamanların en iyi bilim kurgu romanı.',
                'detail'      => '<p>Frank Herbert\'ın başyapıtı. Arrakis gezegeninde geçen epik bir macera. Filmle birlikte yeniden çok satanlar listesine girdi.</p>',
                'price'       => 99, 'stock' => 175, 'minstock' => 20, 'discount' => 0, 'status' => 1,
                'image'       => 'products/product_dune-frank-herbert_1780159868.jpg',
            ],
        ];

        foreach ($products as $data) {
            Product::create($data);
        }

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $this->command->info('✅ ' . Product::count() . ' ürün ve ' . Category::count() . ' kategori eklendi!');
    }
}
