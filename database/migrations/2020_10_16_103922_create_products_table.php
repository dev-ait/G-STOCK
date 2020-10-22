<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('description')->nullable();
            $table->integer('quantite');
            $table->string('statut');
            $table->unsignedBigInteger('modele_id')->nullable();
            $table->foreign('modele_id')->references('id')->on('modeles');
            $table->unsignedBigInteger('gategorie_id');
            $table->foreign('gategorie_id')->references('id')->on('gategories');
            $table->unsignedBigInteger('marque_id');
            $table->foreign('marque_id')->references('id')->on('marques');
            $table->unsignedBigInteger('photo_id');
            $table->foreign('photo_id')->references('id')->on('images');
            $table->float('prix');	
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
