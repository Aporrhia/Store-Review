<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('store_item_attributes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('store_item_id');
            $table->unsignedBigInteger('attribute_id');
            $table->string('value');
            $table->foreign('store_item_id')->references('id')->on('store_items')->onDelete('cascade');
            $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_item_attributes');
    }
};
