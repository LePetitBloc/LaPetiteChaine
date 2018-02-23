<?php

namespace spec\App\Chain\Domain\Aggregate;

use App\Chain\Domain\Aggregate\Block;
use App\Chain\Domain\Aggregate\Chain;
use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\ValueObject\BlockId;
use App\Chain\Domain\ValueObject\ChainId;
use App\Chain\Domain\ValueObject\TransactionId;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ChainSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Chain::class);
    }

    function let()
    {
        $this->beConstructedThrough('init', [
            new ChainId()
        ]);

        $this->getChainId()->shouldImplement(ChainId::class);
        $this->getBlocks()->shouldImplement(Collection::class);
    }

    function it_should_add_a_block(Block $block)
    {
        $block = Block::create(
            new BlockId(1),
            Transaction::create(new TransactionId()),
            new BlockId()
        );

        $this->addBlock($block);

        $block = Block::create(
            new BlockId(2),
            Transaction::create(new TransactionId()),
            new BlockId(1)
        );

        $this->addBlock($block);
        $this->getBlocks()->toArray()->shouldHaveCount(2);
    }
}
