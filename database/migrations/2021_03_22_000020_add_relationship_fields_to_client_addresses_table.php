<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToClientAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('client_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_fk_3487892')->references('id')->on('clients');
        });
    }
}
