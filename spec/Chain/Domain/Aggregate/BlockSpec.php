<?php

namespace spec\App\Chain\Domain\Aggregate;

use App\Chain\Domain\Aggregate\Block;
use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\ValueObject\BlockId;
use App\Chain\Domain\ValueObject\TransactionId;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BlockSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Block::class);
    }

    function let()
    {
        $this->beConstructedThrough('create', [
            new BlockId(),
            Transaction::create(new TransactionId()),
            new BlockId()
        ]);

        $this->getBlockId()->shouldImplement(BlockId::class);
        $this->getCoinbase()->shouldImplement(Transaction::class);
        $this->getTransactions()->shouldImplement(Collection::class);
        $this->getParent()->shouldImplement(BlockId::class);
    }

    function it_should_add_transaction()
    {
        $transaction = Transaction::create(new TransactionId());

        $this->addTransaction($transaction);
        $this->getTransactions()->toArray()->shouldHaveCount(1);
    }
}
