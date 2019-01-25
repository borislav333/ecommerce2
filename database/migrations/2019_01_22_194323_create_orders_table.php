<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->engine='InnoDB';
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('address_options')->unsigned();
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('phone_number');
            $table->string('email_address')->nullable();
            $table->integer('user_id')->nullable()->unsigned();
            $table->boolean('dispatched')->default(0);
            $table->decimal('totalPrice',12,2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
