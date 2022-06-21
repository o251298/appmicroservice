<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use JetBrains\PhpStorm\Internal\LanguageLevelTypeAware;

class AuthException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        Log::channel('api_auth')->error("\n" .  "Line: " . $this->getLine() . "\n" . 'File: ' . $this->getFile() . "\n" . "message: " . $this->getMessage() ."\n");
    }

    public function status()
    {
        return Response::HTTP_UNAUTHORIZED;
    }
    public function getInfo()
    {
        return [
            'status' => 'error',
            'info' => $this->getMessage()
        ];
    }
}
