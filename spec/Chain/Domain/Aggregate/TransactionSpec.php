<?php

namespace spec\App\Chain\Domain\Aggregate;

use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\ValueObject\TransactionId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Transaction::class);
    }

    function let()
    {
        $this->beConstructedThrough('create', [
           new TransactionId(),
        ]);
    }

    function it_should_have_an_identifier()
    {
        $this->getTransactionId()->shouldImplement(TransactionId::class);
    }
}
