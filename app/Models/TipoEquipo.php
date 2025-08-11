<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TipoEquipo extends Model
{
    use HasFactory;

    protected $table = 'tipo_equipo';

    protected $primaryKey = 'tpo_epo_id';

    protected $fillable = ['tpo_epo_descripcion', 'tpo_epo_baja'];

    // Si no usas timestamps, descomenta la siguiente línea:
     public $timestamps = false;

    // Relación con la tabla Equipo
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'epo_tpo_epo_id', 'tpo_epo_id');
    }

    // Si quieres asignación masiva, agrega los campos aquí:
    // protected $fillable = ['nombre', 'direccion', 'telefono', ...];
}
