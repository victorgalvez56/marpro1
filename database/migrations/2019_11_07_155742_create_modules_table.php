<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
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
            $table->timestamps();
        });

        DB::table('modules')->insert([
            ['id' => 1, 'value' => 'dashboard', 'description' => 'Dashboard'],
            ['id' => 2, 'value' => 'configuration', 'description' => 'Configuración'],
            ['id' => 3, 'value' => 'cuenta', 'description' => 'Cuenta'],
            ['id' => 4, 'value' => 'establishments', 'description' => 'Usuarios/Locales & Series'],
            ['id' => 5, 'value' => 'employees', 'description' => 'Empleados'],
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
