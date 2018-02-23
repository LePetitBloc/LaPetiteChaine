<?php

namespace spec\App\Chain\Domain\ValueObject;

use App\Chain\Domain\ValueObject\ChainId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ChainIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ChainId::class);
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

    function it_should_be_equal_to_another_chain_id()
    {
        $chain = clone $this;
        $this->isEqualTo($chain)->shouldReturn(true);
    }

    function it_should_not_be_equal_to_another_chain_id()
    {
        $chainId = new ChainId("2");
        $this->isEqualTo($chainId)->shouldReturn(false);
    }
}
