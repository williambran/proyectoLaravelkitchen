<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
/*
 // Por si se agregan los perfiles de forma manual y despues de crear al usuario, sin eventos, 
    protected $fillable = [
        'user_id', 'biografia','imagen'
    ];
  */  

    //Relacion cn usuario--- le especificamos con el user_id con cua esta relacionado
    public function usuario(){

        return $this->belongsTo(User::class, 'user_id');
    }
}
