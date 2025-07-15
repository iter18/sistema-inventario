<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación muchos a muchos con roles.
     * Un usuario puede tener varios roles.
     */

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'rusu_usu_id', 'rusu_rol_id','id', 'role_id');
    }

    public function organizaciones()
    {
        return $this->belongsToMany(Organizacion::class, 'organizacion_usuario', 'org_usu_usu_id', 'org_usu_org_id', 'id', 'org_id');
    }

    /**
     * Verifica si el usuario tiene un rol específico por nombre.
     */
    public function hasRole($nombreRol)
    {
        return $this->roles->contains('rol_nombre', $nombreRol);
    }

    // Métodos requeridos por JWTSubject

    /**
     * Devuelve el identificador único del usuario para el token JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Devuelve un arreglo con claims personalizados para el token.
     */
    public function getJWTCustomClaims()
    {
        return [
            'user_id' => $this->id,
            'name'    => $this->name,
            'roles'   => $this->roles->pluck('rol_nombre'),
        ];
    }
}
