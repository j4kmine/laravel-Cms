<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProvinsi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('provinsi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('culture')->nullable();
            $table->longText('language')->nullable();
            $table->decimal('lat', 10, 8)->nullable();
            $table->decimal('lng', 11, 8)->nullable();
            $table->longText('tourism_place')->nullable();
            $table->longText('investment_oportunity')->nullable();
            $table->longText('culinary')->nullable();
            $table->longText('transportation')->nullable();
            $table->longText('hotel')->nullable();
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
        //
         Schema::drop('provinsi');
    }
}
