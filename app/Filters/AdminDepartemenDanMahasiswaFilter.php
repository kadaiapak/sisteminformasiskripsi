<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminDepartemenDanMahasiswaFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session()->get('level') != 7 && session()->get('level') != 6 ){
            if(session()->get('log') != true){
                return redirect()->to(base_url('/auth/login'));
            }else {
                return redirect()->to(base_url('/dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
       
    }
}