<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('area')->nullable();
            $table->string('street_name')->nullable();
            $table->string('building_type')->nullable();
            $table->string('building_name')->nullable();
            $table->string('floor_number')->nullable();
            $table->string('apartment_number')->nullable();
            $table->string('landmark')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
