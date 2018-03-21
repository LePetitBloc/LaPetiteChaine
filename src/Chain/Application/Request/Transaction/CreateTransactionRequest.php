<?php
declare(strict_types=1);

namespace App\Chain\Application\Request\Transaction;

use App\AppRequest;
use App\Chain\Application\Request\BadRequest;
use Symfony\Component\PropertyAccess\PropertyAccess;

final class CreateTransactionRequest implements AppRequest
{
    public function __construct() {}

    public static function fromData(array $data = []): self
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        $dto = new self;

        $requiredFields = [];

        foreach ($requiredFields as $field) {

            $value = (string) $accessor->getValue($data, "[$field]");

            if ("" === $value) {
                throw BadRequest::missingField($field);
            }

            $dto->{$field} = (string) $accessor->getValue($data, "[$field]");
        }

        return $dto;
    }

    public function getData(): array
    {
        return [];
    }
}
