<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductAttributesTable extends Migration
{
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_fk_3488087')->references('id')->on('products');
            $table->unsignedBigInteger('parent_attribute_id')->nullable();
            $table->foreign('parent_attribute_id', 'parent_attribute_fk_3488092')->references('id')->on('product_attributes');
        });
    }
}
