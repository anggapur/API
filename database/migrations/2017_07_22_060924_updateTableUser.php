<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users',function(Blueprint $table){
            $table->string('username');
            $table->string('avatar');
            $table->string('address');
            $table->string('phone');
            $table->string('bank');
            $table->string('bank_account');
            $table->string('company_name');
            $table->string('owner_name');
            $table->string('identity_id');
            $table->string('identity_category');
            $table->string('send_from');
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
    }
}
