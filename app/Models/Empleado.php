<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $primaryKey = 'emp_id';

    protected $fillable = [
        'emp_nombre',
        'emp_numero',
        'emp_correo',
        'emp_fecha_ingreso',
        'emp_fecha_baja',
        'emp_baja',
        'emp_id_usu',
        'emp_org_id',
        'emp_dep_id'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'emp_dep_id', 'dep_id');
    }


    // Si no usas timestamps, descomenta la siguiente línea:
    // public $timestamps = false;
}
