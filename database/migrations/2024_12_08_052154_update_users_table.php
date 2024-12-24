<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('password');
            $table->string('usuario')->unique()->after('foto');
            $table->tinyInteger('condicion')->default(1)->comment('0=Deshabilitado, 1=Habilitado')->after('usuario');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['foto', 'usuario', 'condicion']);
        });
    }
}
