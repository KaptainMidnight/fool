<?php

namespace App\Domain\Auth\Exceptions;

use Exception;

class AuthException extends Exception
{
    public static function invalidTelegramData(): self
    {
        return new self('Invalid telegram data');
    }
}
