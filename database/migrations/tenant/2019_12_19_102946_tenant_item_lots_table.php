<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantItemLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_lots', function (Blueprint $table) {
            $table->increments('id');
            $table->string('series');
            $table->date('date');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->string('item_loteable_type');
            $table->unsignedInteger('item_loteable_id');
            $table->boolean('has_sale')->default(false);
            $table->string('state', 20)->nullable();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->index('series');
            $table->index('date');
            $table->index('has_sale');
            $table->index('item_loteable_type');
            $table->index('item_loteable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_lots');
    }
}
