<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("addresses", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("line1");
            $table->string("line2")->default(null);
            $table->string("postal_code");
            $table->string("city");
            $table->string("country");
            $table->unsignedBigInteger("user_id");
            $table->timestamps();

            // Foreign keys
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("addresses");
    }
}
