<?php
declare(strict_types=1);

namespace App\Chain\Application\Request;

class BadRequest extends \RuntimeException
{
    public static function missingField(string $field): BadRequest
    {
       return new self("Malformed data - field {$field} is missing");
    }
}
