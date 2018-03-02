<?php
declare(strict_types=1);

namespace App\Chain\Domain\Enum;

use App\Chain\Domain\Exception\UnknownTransaction;

class TransactionStatus
{
    const UNPROCESSED = "UNPROCESSED";

    const PROCESSED = "PROCESSED";

    protected static $typeName = [
        self::UNPROCESSED => "chain.transaction.unprocessed",
        self::PROCESSED => "chain.transaction.processed",
    ];

    protected static function getValue($type)
    {
        if (!isset(static::$typeName[$type])) {
            throw new UnknownTransaction($type);
        }

        return static::$typeName[$type];
    }
}
