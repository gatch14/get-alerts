<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CryptoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 12);
            $table->char('price', 10);
            $table->enum('choices', ['low', 'high']);
            $table->enum('choices_value', ['BTC', '$']);
            $table->boolean('alerted')->default(false);
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::table('cryptos', function(Blueprint $table) {
            $table->dropForeign('altcoins_user_id_foreign');
        });
        Schema::dropIfExists('cryptos');
    }
}
