<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    //
    /* The attributes that are mass assignable.
    * cmapos que se agregaran 
    * @var array
    */
   protected $fillable = [
       'titulo', 'preparacion', 'ingredientes' ,'imagen','categoria_id'
   ];



    public function categoria(){
//no se pone hasOne, por que es " una categoria receta, pertenece a una receta " y alrevez seria redundante, muchas recetas van a pertenecer a una categorias
        return $this->belongsTo(CategoriaReceta::class);
    }

//ademas de que recetas pertenece a user, en la tablas sql las recetas tienen el id forekey de user
    public function autor(){
        return $this->belongsTo(User::class,'user_id');
    }


    //likes que ha recibido la receta de usuarios-- likes_receta: Se le tiene que decir a laravel ue en "likes_receta" e va a guardar la informacion de la relacion belongstoMany a belongtoMany

    public function likes(){
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
