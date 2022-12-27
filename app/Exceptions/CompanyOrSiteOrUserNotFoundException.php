<?php

namespace App\Exceptions;

use Exception;

class CompanyOrSiteOrUserNotFoundException extends Exception
{
    public function render($request)
    { 
        return response('Не найдена запись!');
    }
}
