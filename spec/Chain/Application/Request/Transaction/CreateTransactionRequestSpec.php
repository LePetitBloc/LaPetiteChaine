<?php

namespace spec\App\Chain\Application\Request\Transaction;

use App\Chain\Application\Request\BadRequest;
use App\Chain\Application\Request\Transaction\CreateTransactionRequest;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateTransactionRequestSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(CreateTransactionRequest::class);
    }
}
