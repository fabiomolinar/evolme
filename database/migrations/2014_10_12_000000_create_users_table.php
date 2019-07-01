<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //common attributes
            $table->engine = 'InnoDB'; //engine used in the mysql database.
            $table->increments('id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('nickname');
            $table->string('password', 60);
            $table->string('password_confirmation',60);
            $table->boolean('notification');
            $table->date('birth_date');
            $table->dateTime('birth_date_update_at');
            $table->enum('gender',['M','F']);
            $table->double('monthly_income');
            $table->dateTime('monthly_income_update_at');
            $table->enum('marital_status',['solteiro','casado','divorciado','outro']);
            $table->dateTime('marital_status_update_at');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
            //attributes for address
            $table->string('zip');
            $table->string('state');
            $table->string('city');
            //attributes for social authentication
            $table->string('provider'); //facebook, gmail, or evolme (when the users registers via registration form).
            $table->string('provider_token'); //we need to save to prevent the need of asking the user for authorization all the time
            $table->string('provider_id'); //we store the id of the respective social provider
            $table->string('avatar'); //the link of the profile image when using facebook or gmail as authenticator
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
