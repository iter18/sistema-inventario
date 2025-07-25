<?php

namespace App\Services\impl;


use App\Services\EmpleadoService;
use Illuminate\Support\Facades\Log;
use App\Repositories\EmpleadoRepository;
use App\Http\Resources\EmpleadoResource;

class EmpleadoServiceImpl implements EmpleadoService
{


    private $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepository)
    {
        $this->empleadoRepository = $empleadoRepository;
    }

    /**
     * Crea un nuevo empleado.
     *
     * @param array $data
     * @return \App\Models\Empleado
     */
    public function crear(array $data,  $usuarioId,  $organizacionId,$username)
    {
        try {
            Log::info('Creando empleado por parte de....: '.$username);
            $data['emp_id_usu'] = (int)$usuarioId;
            $data['emp_org_id'] = (int)$organizacionId;

            $empleado = $this->empleadoRepository->crear($data);
            return $empleado;
        } catch (\Exception $e) {
            Log::error('Error al crear empleado: ' . $e->getMessage());
            throw new \Exception('Error al crear empleado: ' . $e->getMessage());
        }
    }

    /**
     * Obtiene una lista de todos los empleados.
     *
     * @return array
     */
    public function listar($organizacionId,$username,$perPage)
    {
        try{
                Log::info('Obteniendo lista de empleados por parte de usuario:.... '.$username);
                $idOrganizacion = (int)$organizacionId;
                $resPorPagina = (int)$perPage;
                return EmpleadoResource::collection($this->empleadoRepository->listar($idOrganizacion,$resPorPagina));

        }catch(\Exception $e){
            Log::error('Error al obtenmer lista empleado: ' . $e->getMessage());
            throw new \Exception('Error al obtenmer lista empleado: ' . $e->getMessage());
        }

    }
}
