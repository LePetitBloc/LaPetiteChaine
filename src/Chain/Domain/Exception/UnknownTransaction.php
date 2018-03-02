<?php
declare(strict_types=1);

namespace App\Chain\Domain\Exception;

use Throwable;

class UnknownTransaction extends \Exception
{
    public function __construct($type)
    {
        $message = "Unknown transaction type {$type}";

        parent::__construct($message);
    }
}
