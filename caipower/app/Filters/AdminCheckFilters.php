<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminCheckFilters implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        
        if(!session()->has('loggedAdmin')){
            return redirect()->to("admin/login")->with('fail', 'You must be logged In.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}