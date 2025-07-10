<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Organizacion extends Model
{

    use HasFactory;

    protected $table = 'organizacion';

    protected $primaryKey = 'org_id';

    protected $fillable = ['org_nombre', 'org_baja'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'organizacion_usuario', 'org_usu_org_id', 'org_usu_usu_id');
    }
    // Si no usas timestamps, descomenta la siguiente línea:
    // public $timestamps = false;

    // Si quieres asignación masiva, agrega los campos aquí:
    // protected $fillable = ['nombre', 'direccion', 'telefono', ...];
}
