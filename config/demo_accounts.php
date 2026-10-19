<?php

return [
    'admin' => [
        'email' => env('DEMO_ADMIN_EMAIL') ?: null,
        'password' => env('DEMO_ADMIN_PASSWORD') ?: null,
    ],
    'petugas' => [
        'email' => env('DEMO_PETUGAS_EMAIL') ?: null,
        'password' => env('DEMO_PETUGAS_PASSWORD') ?: null,
    ],
];
