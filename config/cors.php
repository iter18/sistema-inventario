<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Aquí puedes configurar las reglas para CORS. Laravel ya viene con
    | valores predeterminados sensatos que puedes ajustar.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'],

    'allowed_methods' => ['*'],

    /*
     * Para desarrollo, puedes usar la URL de tu frontend.
     * En producción, DEBES especificar los dominios de tu frontend.
     * Es una excelente práctica usar una variable de entorno (.env) para esto.
     * En tu .env: CORS_ALLOWED_ORIGINS=http://localhost:3000,https://tu-dominio.com
     */
    'allowed_origins' => ['*'],

    'allowed_origins_patterns' => [],

    /*
     * Encabezados permitidos en la solicitud. Es más seguro ser explícito
     * que usar '*'. He incluido los que necesitas para tu sistema de autenticación.
     */
    'allowed_headers' => [
        'Content-Type',
        'X-Auth-Token',
        'Origin',
        'Authorization', // <-- Esencial para JWT
        'X-organizacionId', // <-- Esencial para tu AuthController
        'X-Requested-With',
    ],

    'exposed_headers' => [],

    'max_age' => 0,

    /*
     * ¡Este es el cambio más importante! Debe ser `true` para que el frontend
     * pueda enviar el token JWT en el encabezado 'Authorization'.
     */
    'supports_credentials' => true,

];
