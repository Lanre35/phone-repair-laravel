<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('part_name');
            $table->unsignedBigInteger('skuId')->unique();
            $table->unsignedBigInteger('categoryId');
            $table->integer('stock_quantity');
            $table->decimal('cost_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->integer('min_stock')->default(10);
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('skuId')->references('id')->on('products');
            $table->foreign('categoryId')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
