<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController
{
    #[Route('/auth', name: 'app_auth')]
    public function __invoke()
    {
        $key = 'example_key';
        $payload = [
            'iss' => 'http://example.org',
            'aud' => 'http://example.com',
            'iat' => 1356999524,
            'nbf' => 1357000000
        ];

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($payload, $key, 'HS256');
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        dd($jwt);

        dd('ok');
    }
}