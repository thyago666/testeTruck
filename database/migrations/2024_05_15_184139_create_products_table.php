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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->bigInteger('code')->unique(); // Código do produto
            $table->string('status')->nullable(); // Status do produto
            $table->timestamp('imported_t')->nullable(); // Data de importação
            $table->string('url')->nullable(); // URL do produto
            $table->string('creator')->nullable(); // Criador do produto
            $table->bigInteger('created_t')->nullable(); // Timestamp de criação
            $table->bigInteger('last_modified_t')->nullable(); // Timestamp da última modificação
            $table->string('product_name')->nullable(); // Nome do produto
            $table->string('quantity')->nullable(); // Quantidade
            $table->string('brands')->nullable(); // Marcas
            $table->string('categories')->nullable(); // Categorias
            $table->string('labels')->nullable(); // Rótulos (pode ser nulo)
            $table->string('cities')->nullable(); // Cidades (pode ser nulo)
            $table->string('purchase_places')->nullable(); // Locais de compra (pode ser nulo)
            $table->string('stores')->nullable(); // Lojas (pode ser nulo)
            $table->text('ingredients_text')->nullable(); // Texto dos ingredientes (pode ser nulo)
            $table->string('traces')->nullable(); // Traços de alérgenos (pode ser nulo)
            $table->string('serving_size')->nullable(); // Tamanho da porção (pode ser nulo)
            $table->string('serving_quantity')->nullable(); // Quantidade por porção (pode ser nulo)
            $table->string('nutriscore_score')->nullable(); // Pontuação Nutri-Score (pode ser nulo)
            $table->string('nutriscore_grade')->nullable(); // Grau Nutri-Score (pode ser nulo)
            $table->string('main_category')->nullable(); // Categoria principal (pode ser nulo)
            $table->string('image_url')->nullable(); // URL da imagem (pode ser nulo)
            $table->timestamps(); // Timestamps de criação e atualização
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
