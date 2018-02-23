<?php
declare(strict_types=1);

namespace App\Chain\Domain\Aggregate;

use App\Chain\Domain\ValueObject\ChainId;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Chain
{
    private $id;

    private $blocks;

    private function __construct()
    {
        $this->blocks = new ArrayCollection();
    }

    public static function init(ChainId $id): self
    {
        $chain = new Chain();
        $chain->id = $id;

        return $chain;
    }

    public function getChainId()
    {
        return $this->id;
    }

    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    public function addBlock(Block $block): void
    {
        if (false === $this->blocks->contains($block)) {
            $this->blocks->add($block);
        }
    }
}
