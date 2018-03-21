<?php
declare(strict_types=1);

namespace App;

interface AppRequest
{
    public static function fromData(array $data = []);

    public function getData(): array;
}
