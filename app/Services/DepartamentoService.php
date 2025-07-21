<?php
namespace App\Services;

interface DepartamentoService
{
    public function listar();

    public function obtenerPorOrganizacion($organizacionId);
}
