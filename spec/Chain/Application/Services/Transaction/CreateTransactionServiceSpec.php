<?php

namespace spec\App\Chain\Application\Services\Transaction;

use App\Chain\Application\Request\Transaction\CreateTransactionRequest;
use App\Chain\Application\Response\Transaction\TransactionResponse;
use App\Chain\Application\Services\Transaction\CreateTransactionService;
use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\Event\Transaction\TransactionCreatedEvent;
use App\Chain\Domain\Repository\TransactionRepository;
use App\Chain\Domain\ValueObject\TransactionId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class CreateTransactionServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CreateTransactionService::class);
    }

    function let(
        TransactionRepository $transactionRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->beConstructedWith($transactionRepository, $eventDispatcher);
    }

    function it_should_create_a_transaction(
        TransactionRepository $transactionRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $transactionId = new TransactionId();
        $transaction = Transaction::create($transactionId);

        $transactionRepository->nextTransactionIdentity()->willReturn($transactionId);
        $transactionRepository->add($transaction)->shouldBeCalled();

        $createTransactionRequest = CreateTransactionRequest::fromData([]);
        $this->execute($createTransactionRequest)->shouldBeAnInstanceOf(TransactionResponse::class);
    }
}
