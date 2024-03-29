<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sites', function (Blueprint $table) {
            $table->id(); 
            $table->string('designation');
            $table->string('type');
            $table->integer('quantite');
            $table->unsignedBigInteger('marque_id');
            $table->foreign('marque_id')->references('id')->on('marques');
            $table->unsignedBigInteger('photo_id');
            $table->foreign('photo_id')->references('id')->on('images');
            $table->unsignedBigInteger('site_id');
            $table->foreign('site_id')->references('id')->on('sites');
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
        Schema::dropIfExists('product_sites');
    }
}
