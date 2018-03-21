<?php
declare(strict_types=1);

namespace App;

interface AppResponse
{
    public function getData(): array;
}
