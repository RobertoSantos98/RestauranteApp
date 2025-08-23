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
        Schema::create('item-produtos', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade')->default(1);
            $table->timestamps();

            $table->unsignedBigInteger('carrinho_id');
            $table->foreign('carrinho_id')->references('id')->on('carrinho')->onDelete('cascade');

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item-produtos');
    }
};
