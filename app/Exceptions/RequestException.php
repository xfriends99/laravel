<?php
namespace App\Exceptions;

use Exception;
use Throwable;

class RequestException extends Exception
{
    /**
     * RequestException constructor.
     * @param string $message [optional] The Exception message to throw.
     * @param int $code
     * @param Throwable $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}