<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Organizacion extends Model
{

    use HasFactory;

    protected $table = 'organizacion';

    protected $primaryKey = 'org_id';

    protected $fillable = ['org_nombre', 'org_baja'];

    protected $casts = [
        'org_baja' => 'boolean',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'organizacion_usuario', 'org_usu_org_id', 'org_usu_usu_id');
    }

    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'dep_org_id', 'org_id');
    }
    // Si no usas timestamps, descomenta la siguiente línea:
    // public $timestamps = false;

    // Si quieres asignación masiva, agrega los campos aquí:
    // protected $fillable = ['nombre', 'direccion', 'telefono', ...];
}
