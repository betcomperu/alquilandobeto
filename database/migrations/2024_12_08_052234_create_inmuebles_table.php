<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmueblesTable extends Migration
{
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('direccion', 255);
            $table->string('provincia', 255);
            $table->string('distrito', 255);
            $table->text('detalles')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('precio', 10, 2);
            $table->string('alias', 255)->nullable();
            $table->tinyInteger('estado')->default(0)->comment('0=Desocupado, 1=Alquilado');
            $table->foreignId('iduser')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inmuebles');
    }
}
