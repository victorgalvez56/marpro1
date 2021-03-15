<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('second_name', 600)->nullable();
            $table->string('description', 600)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('barcode', 150)->nullable();
            $table->string('technical_specifications', 300)->nullable();
            $table->char('item_type_id', 2);
            $table->string('internal_id', 30)->nullable();
            $table->string('item_code')->nullable();
            $table->unsignedInteger('account_id')->nullable();
            $table->date('date_of_due')->nullable();
            $table->string('item_code_gs1')->nullable();
            $table->string('unit_type_id');
            $table->string('currency_type_id');
            $table->decimal('sale_unit_price', 16, 6);
            $table->boolean('purchase_has_igv')->default(true);
            $table->boolean('has_igv')->default(true);
            $table->decimal('purchase_unit_price', 16, 6)->default(0);
            $table->boolean('has_isc')->default(false);
            $table->decimal('commission_amount', 8, 2)->nullable();
            $table->string('line')->nullable();
            $table->string('commission_type')->nullable();
            $table->decimal('amount_plastic_bag_taxes', 6, 2)->default(0.1);
            $table->string('system_isc_type_id')->nullable();
            $table->decimal('percentage_isc', 12, 2)->default(0);
            $table->decimal('suggested_price', 12, 2)->default(0);
            $table->string('sale_affectation_igv_type_id');
            $table->string('purchase_affectation_igv_type_id');
            $table->boolean('calculate_quantity')->default(false);
            $table->decimal('sale_unit_price_set', 16, 6)->nullable();
            $table->boolean('is_set')->default(false);
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('brand_id')->nullable();
            $table->string('image')->default('imagen-no-disponible.jpg');
            $table->string('image_medium')->default('imagen-no-disponible.jpg');
            $table->string('image_small')->default('imagen-no-disponible.jpg');
            $table->decimal('stock', 16, 4)->default(0);
            $table->decimal('stock_min', 12, 2)->default(0);
            $table->boolean('has_plastic_bag_taxes')->default(false);
            $table->string('lot_code')->nullable();
            $table->boolean('lots_enabled')->default(false);
            $table->boolean('series_enabled')->default(false);
            $table->decimal('percentage_of_profit', 12, 2)->default(0);
            $table->boolean('has_perception')->default(false);
            $table->decimal('percentage_perception', 12, 2)->nullable();
            $table->json('attributes')->nullable();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('web_platform_id')->nullable();
            $table->unsignedInteger('warehouse_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->boolean('apply_store')->default(false);
            $table->timestamps();
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->foreign('item_type_id')->references('id')->on('item_types');
            $table->foreign('unit_type_id')->references('id')->on('cat_unit_types');
            $table->foreign('currency_type_id')->references('id')->on('cat_currency_types');
            $table->foreign('system_isc_type_id')->references('id')->on('cat_system_isc_types');
            $table->foreign('sale_affectation_igv_type_id')->references('id')->on('cat_affectation_igv_types');
            $table->foreign('purchase_affectation_igv_type_id')->references('id')->on('cat_affectation_igv_types');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('web_platform_id')->references('id')->on('web_platforms');
            $table->index('name');
            $table->index('second_name');
            $table->index('description');
            $table->index('internal_id');
            $table->index('item_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
        // Schema::dropIfExists('item_types');
    }
}
