<?php
declare(strict_types=1);

namespace App\Chain\Infrastructure\Persistence\Yaml;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class YamlRepository
{
    private $filesystem;

    private $basePath;

    public function __construct(
        Filesystem $filesystem,
        $basePath
    ) {
        $this->filesystem = $filesystem;
        $this->basePath = $basePath;

        if (false === $this->filesystem->exists($basePath)) {
            $this->filesystem->mkdir($basePath);
        }
    }

    public function write($filename, $content): void
    {
        $this->filesystem->dumpFile($this->getBasePath($filename), Yaml::dump($content));
    }

    public function read($filename)
    {
        try {
            return Yaml::parseFile($this->getBasePath($filename));
        } catch (ParseException $e) {
            return [];
        }
    }

    public function getBasePath(string $filename = ""): string
    {
        if ("" !== $filename) {
            return "{$this->basePath}/{$filename}";
        }

        return $this->basePath;
    }
}
