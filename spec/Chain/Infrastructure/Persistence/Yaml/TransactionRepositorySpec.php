<?php

namespace spec\App\Chain\Infrastructure\Persistence\Yaml;

use App\Chain\Infrastructure\Persistence\Yaml\TransactionRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TransactionRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TransactionRepository::class);
    }
}
