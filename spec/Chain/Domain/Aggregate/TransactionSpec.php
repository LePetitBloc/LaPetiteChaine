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

        $this->getTransactionId()->shouldImplement(TransactionId::class);
        $this->getTransactionStatus()->shouldReturn("UNPROCESSED");
    }

    function it_should_resolve_a_transaction()
    {
        $this->resolve();
        $this->getTransactionStatus()->shouldReturn("PROCESSED");
    }
}
