<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("products", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->boolean("enabled")->default(false);
            $table->string("name");
            $table->string("slug");
            $table->text("description");
            $table->json("images");
            $table->unsignedTinyInteger("order");
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
        Schema::dropIfExists("products");
    }
}
