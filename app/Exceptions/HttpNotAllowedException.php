<?php

namespace App\Exceptions;

use Exception;

class HttpNotAllowedException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render($request)
    {
        return response()->json([
            'error' => 'HTTP Method Not Allowed',
            'message' => $this->getMessage() ?: 'The HTTP method you used is not allowed for this route.',
        ], 405);
    }
}