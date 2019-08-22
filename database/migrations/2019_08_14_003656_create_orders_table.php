<?php

use App\Models\Order;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("orders", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->enum("status", Order::STATUSES);
            $table->json("content");
            $table->json("shipping");
            $table->string("receipt_url")->nullable();
            $table->string("stripe_id");
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
        Schema::dropIfExists("orders");
    }
}
