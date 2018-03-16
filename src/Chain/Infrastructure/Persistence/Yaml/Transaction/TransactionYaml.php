<?php
declare(strict_types=1);

namespace App\Chain\Infrastructure\Persistence\Yaml\Transaction;

use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\Repository\TransactionRepository;
use App\Chain\Domain\ValueObject\TransactionId;
use App\Chain\Infrastructure\Persistence\Yaml\YamlRepository;
use Symfony\Component\Filesystem\Filesystem;

class TransactionYaml extends YamlRepository implements TransactionRepository
{
    private $className;

    private $fileName;

    public function __construct(
        Filesystem $filesystem,
        $basePath
    ) {
        parent::__construct($filesystem, $basePath);
        $this->className = Transaction::class;
        $this->fileName = "app_transaction";
    }

    public function findAll()
    {
        $transactions = [];

        foreach ($this->read($this->fileName) as $row) {
            $transactions[] = $this->className::fromDatabase(
                new TransactionId($row['id']),
                $row['status']
            );
        }

        return $transactions;
    }

    public function find(TransactionId $id): ?Transaction
    {
        foreach ($this->findAll() as $persistedTransaction) {
            if($persistedTransaction->getId()->isEqualTo($id)) {
                return $persistedTransaction;
            }
        }

        return null;
    }

    public function add(Transaction $transaction): void
    {
        $transactions = [];

        foreach ($this->findAll() as $persistedTransaction) {
            if (false === $transaction->getId()->isEqualTo($persistedTransaction->getId())) {
                $transactions[] = $persistedTransaction;
            }
        }

        $transactions[] = [
            'id' => $transaction->getId()->getValue(),
            'status' => $transaction->getStatus(),
        ];

        $this->write($this->fileName, $transactions);
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function nextTransactionIdentity(): TransactionId
    {
        return new TransactionId();
    }
}
