<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaction_id');
            $table->string('name');
            $table->string('product_name');
            $table->string('qty');
            $table->string('price');
            $table->text('note_for_seller');
            $table->string('seller_id');
            $table->string('seller_name');
            $table->enum('status',['0','1','2','3','4']);
            $table->string('ongkir_price');
            $table->string('state0');
            $table->string('state1');
            $table->string('state2');
            $table->string('state3');
            $table->string('state4');
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
        Schema::dropIfExists('detail_transactions');
    }
}
