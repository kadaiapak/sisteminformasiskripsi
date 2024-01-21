<?php

namespace App\Validation;

class CekPasswordValidation
{
       // callback function untuk validation rules
       function cek_spasi($str)
       {
           $pattern = '/ /';
           $result = preg_match($pattern, $str);
   
           if ($result)
           {
            //    $this->form_validation->set_message('username_check', 'The %s field can not have a " "');
               return FALSE;
           }
           else
           {
               return TRUE;
           }
       }
}
