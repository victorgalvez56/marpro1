<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantPersonBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number');
            $table->string('cci')->nullable();
            $table->unsignedInteger('person_id');
            $table->unsignedInteger('bank_id');
            $table->string('currency_type_id');
            $table->string('bank_account_type_id');
            $table->foreign('person_id')->references('id')->on('persons');
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('currency_type_id')->references('id')->on('cat_currency_types');
            $table->foreign('bank_account_type_id')->references('id')->on('cat_bank_account_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_bank_accounts');
    }
}
