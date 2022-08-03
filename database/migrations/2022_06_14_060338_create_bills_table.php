<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();

            $table->string('status')->nullable();
            $table->string('date')->nullable();

            $table->string('sn')->nullable();
            $table->string('sn_one')->nullable();
            $table->string('sn_two')->nullable();
            $table->string('sn_three')->nullable();
            $table->string('sn_four')->nullable();

            $table->string('name')->nullable();
            $table->string('name_one')->nullable();
            $table->string('name_two')->nullable();
            $table->string('name_three')->nullable();
            $table->string('name_four')->nullable();

            $table->string('price')->nullable();
            $table->string('price_one')->nullable();
            $table->string('price_two')->nullable();
            $table->string('price_three')->nullable();
            $table->string('price_four')->nullable();

            $table->string('quantity')->nullable();
            $table->string('quantity_one')->nullable();
            $table->string('quantity_two')->nullable();
            $table->string('quantity_three')->nullable();
            $table->string('quantity_four')->nullable();

            $table->string('total')->nullable();
            $table->string('total_one')->nullable();
            $table->string('total_two')->nullable();
            $table->string('total_three')->nullable();
            $table->string('total_four')->nullable();

            $table->string('sub_total')->nullable();
            $table->string('vat')->nullable();
            $table->string('all_total')->nullable();
    

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
        Schema::dropIfExists('bills');
    }
};
