<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('activestore');
            $table->string('mob');
            $table->string('tel');
            $table->string('levelstore');
            $table->string('numbranches');
            $table->string('anothervisite');
            $table->string('firstvisit');
            $table->string('datevisite');
            $table->string('telemploy');
            $table->string('employ');
            $table->string('owner');
            $table->string('adress');
            $table->string('timework');
            $table->string('holidays');
            $table->string('papers');
            $table->string('opinions');
            $table->string('mangeer');
            $table->string('email');
            $table->string('nots');
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
        Schema::dropIfExists('store_data');
    }
}
