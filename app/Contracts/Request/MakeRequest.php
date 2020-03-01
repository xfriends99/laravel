<?php

namespace App\Contracts\Request;

use Exception;
use App\Exceptions\RequestException;

interface MakeRequest
{
    /**
     * @throws Exception|RequestException
     * @return array
     */
    public function send();
}
