<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantCatBankAccountTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_bank_account_types', function (Blueprint $table) {
            $table->string('id')->index();
            $table->string('description');
            $table->boolean('active');
            $table->timestamps();
        });

        DB::table('cat_bank_account_types')->insert([
            ['id' => '01', 'active' => true, 'description' => 'Cuenta corriente'],
            ['id' => '02', 'active' => true, 'description' => 'Cuenta de ahorros'],
            ['id' => '03', 'active' => true, 'description' => 'Cuenta de haberes'],
            ['id' => '04', 'active' => true, 'description' => 'Cuenta de detracciones'],
            ['id' => '05', 'active' => true, 'description' => 'Otras'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cat_bank_account_types');
    }
}
