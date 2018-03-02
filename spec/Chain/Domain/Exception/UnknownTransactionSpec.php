<?php

namespace spec\App\Chain\Domain\Exception;

use App\Chain\Domain\Exception\UnknownTransaction;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UnknownTransactionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UnknownTransaction::class);
    }

    function let()
    {
        $this->beConstructedWith("MICKEY MOUSE");
    }
}
