<?php

return [

'paths' => ['api/*', 'sanctum/csrf-cookie', 'broadcasting/auth'],

'allowed_methods' => ['*'], // Allow all HTTP methods (GET, POST, PUT, etc.)

'allowed_origins' => ['http://localhost:3000','https://3dweldmesh.com'], // Your frontend URL

'allowed_origins_patterns' => [],

'allowed_headers' => ['*'], // Allow all headers

'exposed_headers' => [],

'max_age' => 0,

'supports_credentials' => true,

];
