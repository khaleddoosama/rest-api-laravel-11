<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function __construct(string $message = '', ?\Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct(404, $message, $previous, $headers, $code);
    }
    
}