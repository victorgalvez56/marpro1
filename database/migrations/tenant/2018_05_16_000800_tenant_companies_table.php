<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identity_document_type_id');
            $table->string('number');
            $table->string('name');
            $table->string('trade_name')->nullable();
            $table->char('soap_send_id', 2)->default('01');
            $table->char('soap_type_id', 2);
            $table->string('soap_username')->nullable();
            $table->string('soap_password')->nullable();
            $table->string('soap_url')->nullable();
            $table->string('certificate')->nullable();
            $table->date('certificate_due')->nullable();
            $table->string('logo')->nullable();
            $table->string('detraction_account')->nullable();
            $table->string('logo_store')->nullable();
            $table->string('img_firm')->nullable();
            $table->boolean('operation_amazonia')->default(false);
            $table->string('slogan')->nullable();
            $table->timestamps();
            $table->foreign('identity_document_type_id')->references('id')->on('cat_identity_document_types');
            $table->foreign('soap_type_id')->references('id')->on('soap_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
