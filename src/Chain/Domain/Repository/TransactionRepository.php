<?php

namespace App\Chain\Domain\Repository;

use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\ValueObject\TransactionId;

interface TransactionRepository
{
    public function findAll();

    public function find(TransactionId $id): ?Transaction;

    public function add(Transaction $transaction);

    public function update(Transaction $transaction);

    public function getClassName(): string;

    public function nextTransactionIdentity(): TransactionId;
}
