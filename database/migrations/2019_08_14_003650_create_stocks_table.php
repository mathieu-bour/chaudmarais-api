<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("stocks", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedInteger("price");
            $table->enum("size", ["S", "M", "L"])->nullable();
            $table->unsignedInteger("inventory")->default(0);
            $table->unsignedInteger("available_inventory")->default(0);
            $table->unsignedBigInteger("product_id");
            $table->timestamps();

            // Foreign keys
            $table->foreign("product_id")->references("id")->on("products");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("stocks");
    }
}
