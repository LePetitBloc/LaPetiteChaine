<?php
declare(strict_types=1);

namespace App\Chain\Domain\ValueObject;

use Ramsey\Uuid\Uuid;

final class ChainId
{
    private $value;

    public function __construct(string $value = null)
    {
        $this->value = $value ?: Uuid::uuid4()->toString();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }

    public function getValue(): string
    {
        return (string) $this->value;
    }

    public function isEqualTo(ChainId $chainId)
    {
        return $this->getValue() === $chainId->getValue();
    }
}
