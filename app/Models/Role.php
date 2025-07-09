<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{

    use HasFactory;

    protected $primaryKey = 'role_id';

    protected $fillable = ['rol_nombre'];

    /**
     * Relación muchos a muchos con usuarios.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'rusu_rol_id', 'rusu_usu_id');
    }
}
