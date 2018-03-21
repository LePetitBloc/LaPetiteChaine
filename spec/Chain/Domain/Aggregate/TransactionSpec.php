<?php

namespace spec\App\Chain\Domain\Aggregate;

use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\Enum\TransactionStatus;
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

        $this->getId()->shouldImplement(TransactionId::class);
        $this->getStatus()->shouldReturn(TransactionStatus::UNPROCESSED);
    }

    function it_should_resolve_a_transaction()
    {
        $this->resolve();
        $this->getStatus()->shouldReturn( TransactionStatus::PROCESSED);
    }
}
