<?php
declare(strict_types=1);

namespace App\Chain\Infrastructure\Api\Transaction;

use App\AppResponse;
use App\Chain\Application\Request\BadRequest;
use App\Chain\Application\Request\Transaction\CreateTransactionRequest;
use App\Chain\Application\Services\Transaction\CreateTransactionService;

class CreateTransactionApi
{
    private $createTransactionService;

    public function __construct(
        CreateTransactionService $createTransactionService
    ) {
        $this->createTransactionService = $createTransactionService;
    }

    public function __invoke(array $data = []): AppResponse
    {
        try {
            $request = CreateTransactionRequest::fromData($data);
        } catch (BadRequest $exception) {
            throw new \Exception($exception->getMessage());
        }

        return $this->createTransactionService->execute($request);
    }
}
