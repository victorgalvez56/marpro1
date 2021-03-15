<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token')->unique()->nullable();
            $table->unsignedInteger('establishment_id')->nullable();
            $table->foreign('establishment_id')->references('id')->on('establishments');
            $table->enum('type', ['admin', 'seller', 'integrator', 'client', 'supplier'])->default('admin');
            $table->boolean('locked')->default(false);
            $table->string('identity_document_type_id')->nullable();
            $table->string('number')->nullable();
            $table->string('telephone')->nullable();
            $table->string('address')->nullable();
            $table->rememberToken();
            $table->dateTime('confirmation_date')->nullable();
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
        Schema::dropIfExists('users');
    }
}
