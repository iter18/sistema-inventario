<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpleadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->emp_id,
            'nombre' => $this->emp_nombre,
            'noEmpleado' => $this->emp_numero,
            'correo' => $this->emp_correo,
            'fechaIngreso' => $this->emp_fecha_ingreso,
            'departamento' => [
                'id' => $this->departamento->dep_id,
                'nombre' => $this->departamento->dep_nombre
            ]
        ] ;
    }
}

