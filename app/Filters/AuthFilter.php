<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Login dulu bro!');
        }

        // 🔒 Kalau filter dikasih role (misal: ['superadmin'])
        if ($arguments && !in_array(session()->get('role'), $arguments)) {
            return redirect()->to('/unauthorized')->with('error', 'Akses ditolak');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // kosongin aja
    }
}
