<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
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
			$table->string('Name');
            $table->integer('Price')->nullable()->default(0);
            $table->integer('Quantity')->nullable()->default(0);
            $table->string('Image')->nullable()->default("https://developers.elementor.com/docs/assets/img/elementor-placeholder-image.png");
            $table->string('Description')->nullable()->default("None");
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
