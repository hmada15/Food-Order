<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_fk_3494623')->references('id')->on('clients');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id', 'address_fk_3494699')->references('id')->on('client_addresses');
            $table->unsignedBigInteger('tax_id')->nullable();
            $table->foreign('tax_id', 'tax_fk_3494839')->references('id')->on('tax_values');
            $table->unsignedBigInteger('delivery_fee_id')->nullable();
            $table->foreign('delivery_fee_id', 'delivery_fee_fk_3494840')->references('id')->on('delivery_fees');
        });
    }
}
