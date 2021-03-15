<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantConfigurationMailServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_mail_servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('host');
            $table->string('port');
            $table->string('username');
            $table->string('password');
            $table->text('encryption')->nullable();
            $table->string('driver')->nullable();
            $table->string('protocol')->nullable();
            $table->string('default_account')->nullable();
            $table->boolean('validate_cert')->default(false);
            $table->string('from_address')->nullable();
            $table->string('from_name')->nullable();
            $table->string('reply_address')->nullable();
            $table->string('reply_name')->nullable();
            $table->string('cc_address')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });


        DB::table('configuration_mail_servers')->insert([
            [
                'name' => 'smtp',
                'host' => 'smtp.gmail.com',
                'port' => '465',
                'username' => 'usuario@gmail.com',
                'password' => 'password',
                'encryption' => 'ssl',
                'driver' => 'smtp',
                'created_at' => now()
            ],
        ]);
        DB::table('configuration_mail_servers')->insert([
            [
                'name' => 'imap',
                'host' => 'imap.gmail.com',
                'port' => '993',
                'username' => 'usuario@gmail.com',
                'password' => 'password',
                'encryption' => 'ssl',
                'protocol' => 'imap',
                'default_account' => 'default',
                'validate_cert' => false,
                'created_at' => now()
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuration_mail_servers');
    }
}
