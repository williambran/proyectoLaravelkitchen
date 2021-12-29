<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//creamos otra tabla, esta la agregamos nosotros de cero. El nobre debe de ser este para que su modelo(que vamos a hacer desde 0, se llame CategoriaReceta)
//Tipo de relacion en general: un tipo de receta va a tener muchas recetas.
Schema::create('categoria_recetas',function(Blueprint $table){
$table->id();
$table->string('nombre');
$table->timestamps();
});

        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo'); 
            $table->text('ingredientes'); 
            $table->text('preparacion'); 
            $table->string('imagen'); 
            $table->foreignId('user_id')->references('id')->on('users')->comment('El susario crea la receta'); //este tipo es por que lo traemos de otr tabla , de create user table 
            $table->foreignId('categoria_id')->references('id')->on('categoria_recetas')->comment('La categoria'); //este tipo es por que lo traemos de otr tabla , de create user table 
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
        //al borrar la de recetas, se elimina la de categoria
        Schema::dropIfExists('categoria_receta');
        Schema::dropIfExists('recetas');
    }
}
