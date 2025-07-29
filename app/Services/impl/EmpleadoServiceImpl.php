<?php

namespace App\Services\impl;


use App\Services\EmpleadoService;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\EmpleadoResource;
use App\Repositories\EmpleadoRepository;
use App\Exceptions\RecursoNoEncontradoException;


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

    /**
     * Actualiza un empleado existente.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Empleado
     */
    public function actualizar(int $id, array $data,string $username, $usuarioId)
    {
            Log::info('Actualizando empleado por usuario:...'.$username);
            Log::info('Obteniendo empleado....');
            $empleado = $this->obtenerPorId($id);

            if (!$empleado) {
                Log::error('Empleadossss no encontrado');
                 throw new RecursoNoEncontradoException('Empleadottt no encontrado');
            }
            $empleado->emp_nombre = $data['emp_nombre'];
            $empleado->emp_correo = $data['emp_correo'];
            $empleado->emp_numero = $data['emp_numero'];
            $empleado->emp_fecha_ingreso = $data['emp_fecha_ingreso'];
            $empleado->emp_dep_id = $data['emp_dep_id'];
            $empleado->emp_id_usu =  (int)$usuarioId;

            return $this->empleadoRepository->actualizar($empleado);
    }


    /**
     * Obtener un empleado por su ID.
     *
     * @param int $id
     * @return \App\Models\Empleado
     */
    public function obtenerPorId(int $id)
    {
        return $this->empleadoRepository->obtenerPorId($id);
    }

    /**
     * Elimina un empleado por su ID.
     */



}
