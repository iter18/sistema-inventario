<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmpleadoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * La autorizacion ya la manejamos en el middleware de autenticacion y autorizacion
     * por lo que retornamos true
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Obtenemos el ID del empleado desde la ruta. Será null en la creación.
        $empleadoId = $this->route('id');

         return [
            'nombre' => 'required|string|max:200',
            'numeroEmpleado' => ['required', 'string', 'max:100', Rule::unique('empleados', 'emp_numero')->ignore($empleadoId, 'emp_id')],
            'correo' => ['required', 'string', 'email', 'max:150', Rule::unique('empleados', 'emp_correo')->ignore($empleadoId, 'emp_id')],
            'fechaIngreso' => 'required|date_format:Y-m-d',
            'departamentoId' => ['required', 'integer', Rule::exists('departamento', 'dep_id')],
        ];
    }

    /**
    * Método para expecificar mensajes de error personalizados.
    */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del empleado es obligatorio.',
            'numeroEmpleado.required' => 'El número de empleado es obligatorio.',
            'numeroEmpleado.string' => 'El número de empleado debe ser una cadena de texto.',
            'numeroEmpleado.unique' => 'Este número de empleado ya está en uso.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El formato del correo no es válido.',
            'correo.unique' => 'Este correo electrónico ya está registrado.',
            'fechaIngreso.required' => 'La fecha de ingreso es obligatoria.',
            'fechaIngreso.date_format' => 'La fecha de ingreso debe tener el formato AAAA-MM-DD.',
            'departamentoId.required' => 'El departamento es obligatorio.',
            'departamentoId.exists' => 'El departamento seleccionado no es válido.',
        ];
    }

       /**
     * Prepara los datos para la creación en el servicio.
     * Mapea las claves de la API a las claves de la base de datos.
     */
    public function toDatabase(): array
    {
        $data = $this->validated();

        return [
            'emp_nombre' => $data['nombre'],
            'emp_numero' => $data['numeroEmpleado'],
            'emp_correo' => $data['correo'],
            'emp_fecha_ingreso' => $data['fechaIngreso'],
            'emp_dep_id' => $data['departamentoId'],
            // Podemos establecer valores por defecto aquí también
            'emp_baja' => false,
            'emp_fecha_baja' => null,
        ];
    }

    /**
     * Maneja un intento de validación fallido para devolver un único y simple mensaje de error.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        // Obtenemos el primer mensaje de error de la colección de errores.
        $firstError = $validator->errors()->first();

        // Lanzamos una excepción con nuestra respuesta JSON personalizada.
        throw new HttpResponseException(response()->json([
            'message' => $firstError
        ], 422)); // O 422 si prefieres el estándar para validación.
    }
}
