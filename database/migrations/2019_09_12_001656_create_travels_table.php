<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address_from')->nullable();
            $table->mediumText('info');
            $table->string('image');
            $table->mediumText('gallery')->nullable();
            $table->string('type', 20)->default('other'); // pilgrimage, umrah, other
            $table->string('umrah_date')->nullable();
            $table->boolean('haram_distance')->nullable();
            $table->boolean('favorite_company')->default(0);
            $table->boolean('display')->default(1);
            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('travel_type_id');
            $table->unsignedInteger('user_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreign('travel_type_id')->references('id')->on('travel_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('travels');
    }
}