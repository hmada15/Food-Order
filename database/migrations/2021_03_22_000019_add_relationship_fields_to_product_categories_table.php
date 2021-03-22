<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_category_id')->nullable();
            $table->foreign('parent_category_id', 'parent_category_fk_3488854')->references('id')->on('product_categories');
        });
    }
}
