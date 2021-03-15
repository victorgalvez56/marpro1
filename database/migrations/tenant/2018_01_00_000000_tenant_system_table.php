<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantSystemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state_types', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
        });

        DB::table('state_types')->insert([
            ['id' => '01', 'description' => 'Registrado'],
            ['id' => '03', 'description' => 'Enviado'],
            ['id' => '05', 'description' => 'Aceptado'],
            ['id' => '07', 'description' => 'Observado'],
            ['id' => '09', 'description' => 'Rechazado'],
            ['id' => '11', 'description' => 'Anulado'],
            ['id' => '13', 'description' => 'Por anular'],
            ['id' => '81', 'description' => 'Por Validar'],
        ]);

        Schema::create('soap_types', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
        });

        DB::table('soap_types')->insert([
            ['id' => '01', 'description' => 'Demo'],
            ['id' => '02', 'description' => 'Producción'],
            ['id' => '03', 'description' => 'Interno'],
        ]);

        Schema::create('groups', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
        });

        DB::table('groups')->insert([
            ['id' => '01', 'description' => 'Facturas'],
            ['id' => '02', 'description' => 'Boletas'],
        ]);

        Schema::create('item_types', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
        });

        DB::table('item_types')->insert([
            ['id' => '01', 'description' => 'Producto'],
            ['id' => '02', 'description' => 'Servicio']
        ]);

        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        DB::table('banks')->insert([
            ['id' => 1, 'description' => 'BANCO SCOTIABANK'],
            ['id' => 2, 'description' => 'BANCO DE CREDITO DEL PERU'],
            ['id' => 3, 'description' => 'BANCO DE COMERCIO'],
            ['id' => 4, 'description' => 'BANCO PICHINCHA'],
            ['id' => 5, 'description' => 'BBVA CONTINENTAL'],
            ['id' => 6, 'description' => 'INTERBANK'],
        ]);

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_id');
            $table->string('description');
            $table->string('number');
            $table->string('cci')->nullable();
            $table->string('currency_type_id');
            $table->tinyInteger('status')->default(1);
            $table->decimal('initial_balance', 12, 2)->default(0);
            $table->boolean('show_in_documents')->default(true);
            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('currency_type_id')->references('id')->on('cat_currency_types');
        });

        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->date('date')->primary();
            $table->decimal('sale_original', 13, 3);
            $table->decimal('purchase_original', 13, 3);
            $table->decimal('purchase', 13, 3);
            $table->decimal('sale', 13, 3);
            $table->date('date_original');
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
        Schema::dropIfExists('exchange_rates');
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('item_types');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('soap_types');
        Schema::dropIfExists('process_types');
        Schema::dropIfExists('state_types');
    }
}
