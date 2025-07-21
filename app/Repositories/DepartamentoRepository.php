<?php

namespace App\Repositories;

interface DepartamentoRepository
{
    public function listar();

    public function obtenerPorOrganizacion($organizacionId);
}
