<?php
declare(strict_types=1);

namespace App\Chain\Domain\Aggregate;

use App\Chain\Domain\ValueObject\BlockId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Block
{
    private $id;

    private $coinbase;

    private $transactions;

    private $parent;

    private function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    public static function create(
        BlockId $blockId,
        Transaction $coinbase,
        BlockId $parent
    ): self
    {
        $block = new Block();
        $block->id = $blockId;
        $block->coinbase = $coinbase;
        $block->parent = $parent;

        return $block;
    }

    public function getBlockId(): BlockId
    {
        return $this->id;
    }

    public function getCoinbase(): Transaction
    {
        return $this->coinbase;
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function getParent(): BlockId
    {
        return $this->parent;
    }

    public function addTransaction(Transaction $transaction): void
    {
        if (false === $this->transactions->contains($transaction)) {
            $this->transactions->add($transaction);
        }
    }
}
