<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamento';

    protected $primaryKey = 'dep_id';

    protected $fillable = ['dep_nombre', 'dep_clave', 'dep_baja'];

    public function organizacion()
    {
        return $this->belongsTo(Organizacion::class, 'dep_org_id', 'org_id');
    }

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'emp_dep_id', 'dep_id');
    }

    // Si no usas timestamps, descomenta la siguiente línea:
    // public $timestamps = false;

    // Si quieres asignación masiva, agrega los campos aquí:
    // protected $fillable = ['nombre', 'direccion', 'telefono', ...];
}
