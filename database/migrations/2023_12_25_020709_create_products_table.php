<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id')->length(20);
            $table->string('name');
            $table->string('slug');
            $table->integer('price')->default(0);
            $table->integer("sale")->nullable()->default(0);
            $table->string('title')->nullable();
            $table->longText('content')->nullable();
            $table->string('avatar')->nullable();
            $table->jsonb("image_list")->nullable();
            $table->boolean('is_sale')->default(false);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_hot')->default(false);
            $table->integer('total_view')->default(0);
            $table->integer('total_pay')->nullable()->default(0);
            $table->integer('total_number')->nullable()->default(0);
            $table->integer('total_rating')->nullable()->default(0);
            $table->integer('total_number_rating')->nullable()->default(0);
            $table->unsignedBigInteger('category_id');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
