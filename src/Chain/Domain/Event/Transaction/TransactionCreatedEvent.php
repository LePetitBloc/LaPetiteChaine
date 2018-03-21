<?php
declare(strict_types=1);

namespace App\Chain\Domain\Event\Transaction;

use App\Chain\Application\Response\Transaction\TransactionResponse;
use App\Chain\Domain\Aggregate\Transaction;
use Symfony\Component\EventDispatcher\Event;

class TransactionCreatedEvent extends Event
{
    private $transaction;

    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    public function getTransaction(): Transaction
    {
        return $this->transaction;
    }

    public function getData(): array
    {
        return (new TransactionResponse($this->transaction))->getData();
    }
}
