<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->integer('id')->unsigned()->primary();
            $table->string('value');
            $table->string('description');
            $table->integer('order_menu');
            $table->timestamps();
        });

        DB::table('modules')->insert([
            ['id' => 1, 'value' => 'dashboard', 'description' => 'Dashboard', 'order_menu' => 1],
            ['id' => 2, 'value' => 'configuration', 'description' => 'Configuration', 'order_menu' => 2],
            ['id' => 3, 'value' => 'cuenta', 'description' => 'Cuenta', 'order_menu' => 3],
            ['id' => 4, 'value' => 'establishments', 'description' => 'Usuarios/Locales & Series', 'order_menu' => 4],
            ['id' => 5, 'value' => 'employees', 'description' => 'Empleados', 'order_menu' => 5],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules');
    }
}
