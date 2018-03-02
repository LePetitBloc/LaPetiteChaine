<?php

namespace spec\App\Chain\Domain\Enum;

use App\Chain\Domain\Enum\TransactionStatus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionStatusSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TransactionStatus::class);
    }
}
