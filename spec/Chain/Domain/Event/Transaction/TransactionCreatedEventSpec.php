<?php

namespace spec\App\Chain\Domain\Event\Transaction;

use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\Event\Transaction\TransactionCreatedEvent;
use App\Chain\Domain\ValueObject\TransactionId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionCreatedEventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TransactionCreatedEvent::class);
    }

    function let()
    {
        $transaction = Transaction::create(new TransactionId());
        $this->beConstructedWith($transaction);
    }

    function it_should_have_a_transaction()
    {
        $this->getTransaction()->shouldImplement(Transaction::class);
    }

    function it_should_have_data()
    {
        $this->getData()->shouldBeArray();
    }
}
