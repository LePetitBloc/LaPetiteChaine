<?php
declare(strict_types=1);

namespace App\Chain\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

final class TransactionId
{
    private $value;

    public function __construct(string $value = null)
    {
        $this->value = $value ?: Uuid::uuid4();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return (string) $this->value;
    }

    public function isEqualTo(TransactionId $transactionId)
    {
        return $this->getValue() === $transactionId->getValue();
    }
}
