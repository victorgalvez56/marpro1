<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('send_auto');
            $table->string('formats')->default('default');
            $table->boolean('cron')->default(true);
            $table->boolean('stock')->default(true);
            $table->boolean('sunat_alternate_server')->default(false);
            $table->boolean('locked_emission')->default(false);
            $table->json('plan')->nullable();
            $table->boolean('enable_whatsapp')->default(true);
            $table->string('phone_whatsapp')->nullable();
            $table->json('visual')->nullable();
            $table->tinyInteger('decimal_quantity')->default(2);
            $table->datetime('date_time_start')->nullable();
            $table->integer('quantity_documents');
            $table->boolean('locked_tenant')->default(false);
            $table->boolean('compact_sidebar')->default(false);
            $table->decimal('amount_plastic_bag_taxes', 6, 2)->default(0.1);
            $table->boolean('config_system_env')->default(true);
            $table->tinyInteger('colums_grid_item')->nullable()->default(4);
            $table->boolean('options_pos')->default(true);
            $table->boolean('edit_name_product')->default(true);
            $table->boolean('restrict_receipt_date')->default(true);
            $table->string('affectation_igv_type_id')->default('10');
            $table->boolean('include_igv')->nullable();
            $table->boolean('product_only_location')->nullable();
            $table->text('terms_condition')->nullable();
            $table->text('terms_condition_sale')->nullable();
            $table->boolean('cotizaction_finance')->default(true);
            $table->boolean('legend_footer')->default(false);
            $table->string('header_image')->nullable();
            $table->json('banners')->nullable();
            $table->json('discards')->nullable();
            $table->boolean('destination_sale')->default(true);
            $table->boolean('default_document_type_03')->default(true);
            $table->boolean('locked_users')->default(false);
            $table->bigInteger('limit_documents')->default(0);
            $table->bigInteger('limit_users')->default(10);
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
        Schema::dropIfExists('configurations');
    }
}
