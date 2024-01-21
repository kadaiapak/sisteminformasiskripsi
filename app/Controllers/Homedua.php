<?php

namespace App\Controllers;

class Homedua extends BaseController
{
    public function index(): string
    {
        $data = [
            'judul' => 'Home',
        ];
        return view('pages/v_homedua', $data);
    }
}
