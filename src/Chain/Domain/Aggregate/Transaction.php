<?php
declare(strict_types=1);

namespace App\Chain\Domain\Aggregate;

use App\Chain\Domain\Enum\TransactionStatus;
use App\Chain\Domain\ValueObject\TransactionId;

class Transaction
{
    private $id;

    private $status;

    private function __construct()
    {
    }

    public static function create(
        TransactionId $id
    ): self {
        $transaction = new Transaction();
        $transaction->id = $id;
        $transaction->status = TransactionStatus::UNPROCESSED;

        return $transaction;
    }

    public static function fromDatabase(
        TransactionId $id,
        $status
    ): self {
        $transaction = new Transaction();
        $transaction->id = $id;
        $transaction->status = $status;

        return $transaction;
    }

    public function getId(): TransactionId
    {
        return $this->id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function resolve()
    {
        $this->status = TransactionStatus::PROCESSED;
    }
}
