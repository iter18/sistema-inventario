<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marca';
    protected $primaryKey = 'mar_id';
    protected $fillable = ['mar_descripcion', 'mar_baja'];

    // Si no usas timestamps, descomenta la siguiente línea:
    public $timestamps = false;

    //relacion con la tabla Equipo
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'epo_mar_id', 'mar_id');
    }
}
