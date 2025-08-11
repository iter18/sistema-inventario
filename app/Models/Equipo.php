<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipo';

    protected $primaryKey = 'epo_id';

    protected $fillable = [
        'epo_descripcion',
        'epo_num_serie',
        'epo_modelo',
        'epo_fecha_adquisicion',
        'epo_activo_fijo',
        'epo_num_activo',
        'epo_notas',
        'epo_baja',
        'epo_tpo_epo_id',
        'epo_mar_id',
        'epo_id_usu',
        'epo_id_org'
    ];

    // Relación con la tabla Marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'epo_mar_id', 'mar_id');
    }

    // Relación con la tabla TipoEquipo
    public function tipoEquipo()
    {
        return $this->belongsTo(TipoEquipo::class, 'epo_tpo_epo_id', 'tpo_epo_id');
    }

    // Si no usas timestamps, descomenta la siguiente línea:
    // public $timestamps = false;
}
