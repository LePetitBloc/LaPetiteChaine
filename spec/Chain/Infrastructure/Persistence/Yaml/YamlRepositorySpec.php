<?php

namespace spec\App\Chain\Infrastructure\Persistence\Yaml;

use App\Chain\Infrastructure\Persistence\Yaml\YamlRepository;
use org\bovigo\vfs\vfsStream;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Filesystem\Filesystem;

class YamlRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(YamlRepository::class);
    }

    function let()
    {
        $root = vfsStream::setup();
        $this->beConstructedWith(new Filesystem(), $root->url());
    }

    function it_should_have_a_base_path()
    {
        $this->getBasePath()->shouldReturn("vfs://root");
        $this->getBasePath("test")->shouldReturn("vfs://root/test");
    }

    function it_should_write_content_in_a_file()
    {
        $filename = (string) mt_rand();

        $this->write($filename, "It's a block, it's a chain, it's a blockchain!");
        $this->read($filename)->shouldContain("chain");
    }
}
