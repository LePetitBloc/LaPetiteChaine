<?php
declare(strict_types=1);

namespace App\Chain\Application\Response\Transaction;

use App\AppResponse;
use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\ValueObject\TransactionId;

final class TransactionResponse implements AppResponse
{
    private $transaction;

    private $status;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction->getId();
        $this->status = $transaction->getStatus();
    }

    public function getTransaction(): TransactionId
    {
        return $this->transaction;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getData(): array
    {
        return [
            'transaction' => $this->getTransaction()->getValue(),
            'status' => $this->getStatus(),
        ];
    }
}
