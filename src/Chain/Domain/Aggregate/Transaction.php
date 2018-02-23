<?php
declare(strict_types=1);

namespace App\Chain\Domain\Aggregate;

use App\Chain\Domain\ValueObject\TransactionId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Transaction
{
    private $id;

    private function __construct()
    {
    }

    public static function create(
        TransactionId $id
    ): self
    {
        $transaction = new Transaction();
        $transaction->id = $id;

        return $transaction;
    }

    public function getTransactionId(): TransactionId
    {
        return $this->id;
    }
}
