<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->string('direccion');
            $table->string('provincia');
            $table->string('distrito');
            $table->text('detalles')->nullable();
            $table->string('foto')->nullable();
            $table->decimal('precio', 10, 2);
            $table->string('alias')->nullable();
            $table->boolean('estado')->default(true);
            $table->foreignId('iduser')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('inmuebles');
    }
}
