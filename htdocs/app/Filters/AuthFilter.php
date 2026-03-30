<?php
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $username = $request->getServer('PHP_AUTH_USER');
        $password = $request->getServer('PHP_AUTH_PW');

        $AUTH_USERS = [
            'authuser' => 'gabuzomeu', 
            'duduche'  => 'meuzobuga'
        ];

        $isAuthenticated = isset($AUTH_USERS[$username]) && $AUTH_USERS[$username] === $password;

        if (!$isAuthenticated) {
            return Services::response()
                ->setStatusCode(401)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Authentification incorrecte'
                ]);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the controller executes
    }
}