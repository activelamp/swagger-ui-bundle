<?php


namespace ActiveLAMP\Bundle\SwaggerUIBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class WebTestCase extends BaseCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function setUp()
    {
        $this->cleanup();
        parent::setUp();
    }

    protected static function getKernelClass()
    {
        return __NAMESPACE__ . '\\Application\\AppKernel';
    }

    protected function getContainer()
    {
        if (!static::$kernel) {
            static::bootKernel();
            $this->container = static::$kernel->getContainer();
        }

        return $this->container;
    }

    private function cleanup()
    {
        $dir = sys_get_temp_dir() . '/al_swagger_ui/' . Kernel::VERSION;
        if (file_exists($dir)) {
            $fs = new Filesystem();
            $fs->remove($dir);
        }
    }
}
