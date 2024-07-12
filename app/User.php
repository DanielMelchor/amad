<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Wildside\Userstamps\Userstamps;
use Spatie\Permission\Traits\HasRoles;
use Auth;
use Redirect;

class User extends Authenticatable
{
    use Notifiable;
    use Userstamps;
    use HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'imagen', 'estado'
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

    public function adminlte_image(){
        if (isset(Auth::user()->profile_picture)) {
            return asset("storage/".Auth::user()->profile_picture);
        }else{
            //return 'https://picsum.photos/300/300';
            return asset('storage/profile_pictures/user_default.png');
        }
    }

    public function adminlte_desc() {
        if (isset(Auth::user()->username)) {
            return Auth::user()->username;
        }else{
            return NULL;
        }
    }

    public function adminlte_profile_url()
    {
        return 'usuarios/perfil';
        //return redirect()->route('perfil');
    }
}
