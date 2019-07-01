<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            //common attributes
            $table->engine = 'InnoDB'; //engine used in the mysql database.
            $table->increments('id');
            $table->string('name');
            $table->string('site');
            $table->string('twitter');
            $table->string('facebook');
            $table->string('phone');
            $table->string('address');
            $table->string('cnpj');
            $table->boolean('is_verified');
            //attributes for location
            $table->string('zip');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('state');
            $table->string('city');
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
        Schema::drop('organizations');
    }
}
