<?php

namespace spec\App\Chain\Application\Response\Transaction;

use App\Chain\Application\Response\Transaction\TransactionResponse;
use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\Enum\TransactionStatus;
use App\Chain\Domain\ValueObject\TransactionId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionResponseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TransactionResponse::class);
    }

    function let(Transaction $transaction)
    {
        $transaction = Transaction::create(new TransactionId(1));
        $this->beConstructedWith($transaction);
    }

    function it_should_have_an_identifier()
    {
        $this->getTransaction()->shouldImplement(TransactionId::class);
    }

    function it_should_have_a_status()
    {
        $this->getStatus()->shouldReturn(TransactionStatus::UNPROCESSED);
    }

    function it_should_have_some_data()
    {
        $this->getData()->shouldHaveKeyWithValue('transaction', "1");
        $this->getData()->shouldHaveKeyWithValue('status', "UNPROCESSED");
    }
}
