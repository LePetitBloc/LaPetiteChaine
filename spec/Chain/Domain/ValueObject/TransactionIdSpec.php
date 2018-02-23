<?php

namespace spec\App\Chain\Domain\ValueObject;

use App\Chain\Domain\ValueObject\TransactionId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TransactionId::class);
    }

    function let()
    {
        $this->beConstructedWith("1");
    }

    function it_should_have_a_value()
    {
        $this->__toString()->shouldBeString();
        $this->getValue()->shouldBeString();
    }

    function it_should_be_equal_to_another_transaction_id()
    {
        $tx = clone $this;
        $this->isEqualTo($tx)->shouldReturn(true);
    }

    function it_should_not_be_equal_to_another_transaction_id()
    {
        $txId = new TransactionId("2");
        $this->isEqualTo($txId)->shouldReturn(false);
    }
}
