<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToApartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartments', function (Blueprint $table) {
            $table->tinyInteger('swimming_pool')->default(0);
            $table->tinyInteger('kids_park')->default(0);
            $table->tinyInteger('parking_Space')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartments', function(Blueprint $table)
        {
            $table->dropColumn('swimming_pool');
            $table->dropColumn('kids_parking');
            $table->dropColumn('parking_space');
        });
    }
}
