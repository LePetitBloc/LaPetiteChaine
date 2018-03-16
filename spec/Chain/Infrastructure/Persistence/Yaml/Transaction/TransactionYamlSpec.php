<?php

namespace spec\App\Chain\Infrastructure\Persistence\Yaml\Transaction;

use App\Chain\Domain\Aggregate\Transaction;
use App\Chain\Domain\Enum\TransactionStatus;
use App\Chain\Domain\ValueObject\TransactionId;
use App\Chain\Infrastructure\Persistence\Yaml\Transaction\TransactionYaml;
use org\bovigo\vfs\vfsStream;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;

class TransactionYamlSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TransactionYaml::class);
    }

    function let()
    {
        $root = vfsStream::setup();
        $this->beConstructedWith(new Filesystem(), $root->url());
    }

    function it_should_add_a_transaction()
    {
        $transaction = Transaction::create(new TransactionId(1));
        $this->add($transaction);
        $this->findAll()->shouldHaveCount(1);
    }

    function it_should_not_add_two_identical_transaction()
    {
        $transaction = Transaction::create(new TransactionId(2));
        $this->add($transaction);
        $this->add($transaction);

        $this->findAll()->shouldHaveCount(1);
    }
}
