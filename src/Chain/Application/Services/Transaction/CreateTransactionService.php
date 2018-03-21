<?php
declare(strict_types=1);

namespace App\Chain\Application\Services\Transaction;

use App\Chain\Application\Request\Transaction\CreateTransactionRequest;
use App\Chain\Application\Response\Transaction\TransactionResponse;
use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\ChainEvents;
use App\Chain\Domain\Event\Transaction\TransactionCreatedEvent;
use App\Chain\Domain\Repository\TransactionRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateTransactionService
 */
class CreateTransactionService
{
    private $transactionRepository;

    private $eventDispatcher;

    public function __construct(
        TransactionRepository $transactionRepository,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->transactionRepository = $transactionRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(CreateTransactionRequest $request): TransactionResponse
    {
        $transaction = Transaction::create(
            $this->transactionRepository->nextTransactionIdentity()
        );

        $this->transactionRepository->add($transaction);

        $event = new TransactionCreatedEvent($transaction);
        $this->eventDispatcher->dispatch(ChainEvents::TRANSACTION_CREATED, $event);

        return new TransactionResponse($transaction);
    }
}
