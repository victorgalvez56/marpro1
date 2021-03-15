<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantModuleLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->string('description');
            $table->unsignedInteger('module_id');
            $table->foreign('module_id')->references('id')->on('modules');
            $table->timestamps();
        });

        DB::table('module_levels')->insert([
            ['value' => 'payment_receipts', 'description' => 'Boletas de pago', 'module_id' => 5],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_levels');
    }
}
