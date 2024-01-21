<?php

namespace App\Controllers;

use App\Models\SkripsiModel;
use App\Models\DosenModel;

class Surat extends BaseController
{
    protected $skripsiModel;
    protected $dosenModel;
    public function __construct()
    {
        $this->skripsiModel = new SkripsiModel();
        $this->dosenModel = new DosenModel();
    }

    public function preview($id)
    {
       echo 'test'. $id;
    }
   
}
