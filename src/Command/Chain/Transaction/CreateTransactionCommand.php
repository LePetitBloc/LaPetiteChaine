<?php
declare(strict_types=1);

namespace App\Command\Chain\Transaction;

use App\Chain\Infrastructure\Api\Transaction\CreateTransactionApi;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTransactionCommand extends Command
{
    private $createTransactionApi;

    public function __construct(
        CreateTransactionApi $createTransactionApi
    ) {
        $this->createTransactionApi = $createTransactionApi;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:create:transaction')
            ->setDescription('Create a new transaction in the pool');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = ($this->createTransactionApi)();
        $output->write($response->getData());
    }
}
