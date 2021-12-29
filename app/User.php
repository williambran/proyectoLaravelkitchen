<?php
//Esta clase la creo cuando le dimos que queriamos autenticacio automatica
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password' ,'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    //Evento ue se ejecuta cuando un usuario es creado  y crea un nuevo perfil al crear un nuevo usuario 
    protected static function boot(){
        parent::boot();
        
        //asignar perfil una vez se haya creado  un usuario nuevo 

        static::created(function($user){
            $user->perfil()->create();  //Metodos de elouentes que crea el perfil
        });
    }

/**
 * The relationships beetwend self(user) and recetas
 * attribute "recetas" owner of User
 */
    public function recetas(){

        return $this->hasMany(Receta::class);
    }


    //Relacion 1 a 1 con usuario y perfil
    public function perfil(){

        return $this->hasOne(Perfil::class);
    }


    //recetas a las que el usuario ha dado megusta
    public function meGusta(){

        return $this->belongsToMany(Receta::class, 'likes_receta');
    }

}
