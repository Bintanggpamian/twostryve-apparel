<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('color_name');
            $table->string('color_hex')->default('#000000');
            $table->string('size');
            $table->integer('stock')->default(0);
            $table->string('sku')->nullable();
            $table->decimal('extra_price', 12, 2)->default(0);
            $table->timestamps();

            $table->unique(['product_id', 'color_name', 'size']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
