<?php

namespace spec\App\Chain\Domain\ValueObject;

use App\Chain\Domain\ValueObject\BlockId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BlockIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(BlockId::class);
    }

    function let()
    {
        $this->beConstructedWith();
    }

    function it_should_have_a_value()
    {
        $this->__toString()->shouldBeString();
        $this->getValue()->shouldBeString();
    }

    function it_should_be_equal_to_another_block_id()
    {
        $block = clone $this;
        $this->isEqualTo($block)->shouldReturn(true);
    }

    function it_should_not_be_equal_to_another_block_id()
    {
        $blockId = new BlockId("2");
        $this->isEqualTo($blockId)->shouldReturn(false);
    }
}
