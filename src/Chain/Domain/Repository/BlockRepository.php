<?php

namespace App\Chain\Domain\Repository;

use App\Chain\Domain\Aggregate\Block;
use App\Chain\Domain\ValueObject\BlockId;

interface BlockRepository
{
    public function findAll();

    public function find(BlockId $id): ?Block;

    public function add(Block $block);

    public function update(Block $block);

    public function getClassName(): string;

    public function nextBlockIdentity(): BlockId;
}
