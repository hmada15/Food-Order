<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxValuesTable extends Migration
{
    public function up()
    {
        Schema::create('tax_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
