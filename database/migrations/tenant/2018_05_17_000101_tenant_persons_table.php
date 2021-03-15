<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TenantPersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', ['customers', 'suppliers']);
            $table->string('identity_document_type_id');
            $table->string('number');
            $table->string('name');
            $table->string('trade_name')->nullable();
            $table->string('internal_code', 100)->nullable();
            $table->char('country_id', 2);
            $table->char('department_id', 2)->nullable();
            $table->char('province_id', 4)->nullable();
            $table->char('district_id', 6)->nullable();
            $table->string('address')->nullable();
            $table->string('condition')->nullable();
            $table->string('state')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('perception_agent')->default(false);
            $table->boolean('is_reception')->default(false);
            $table->boolean('is_extranet')->default(false);
            $table->unsignedInteger('person_type_id')->nullable();
            $table->json('contact')->nullable();
            $table->json('contacts')->nullable();
            $table->string('comment')->nullable();
            $table->decimal('percentage_perception', 12, 2)->nullable();
            $table->boolean('enabled')->default(true);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
            $table->foreign('identity_document_type_id')->references('id')->on('cat_identity_document_types');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->foreign('person_type_id')->references('id')->on('person_types');
            $table->index('enabled');
            $table->index('name');
            $table->index('number');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
