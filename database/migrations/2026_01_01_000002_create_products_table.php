<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Yabancı Anahtarlar
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Ürün Bilgi Alanları
            $table->string('title');
            $table->string('keywords')->nullable();
            $table->string('description')->nullable();
            $table->longText('detail')->nullable();
            $table->string('image')->nullable();

            // Sayısal ve Durum Alanları
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->integer('minstock')->default(0);
            $table->integer('discount')->default(0);
            $table->tinyInteger('status')->default(0); // 0=Pasif, 1=Aktif

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
