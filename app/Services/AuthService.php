<?php
namespace App\Services;

interface AuthService
{
    public function login(array $credentials);
}
