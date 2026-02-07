<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            // Relasi ke Transaksi
            $table->foreignId('transaction_id')->constrained('transactions')->onDelete('cascade');
            
            // Relasi ke Produk
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            
            $table->integer('qty');
            $table->bigInteger('price');
            $table->bigInteger('subtotal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaction_details');
    }
};