<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('house_number');
            $table->integer('apartment_id');
            $table->integer('bedroom')->default(0);
            $table->string('kitchen')->nullable();
            $table->integer('bathroom')->default(0);
            $table->integer('toilet')->default(0);
            $table->integer('balcony')->default(0);
            $table->integer('floor')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
