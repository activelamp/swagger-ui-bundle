<?php


namespace ActiveLAMP\Bundle\SwaggerUIBundle\Tests\Application;

use ActiveLAMP\Bundle\SwaggerUIBundle\ALSwaggerUIBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    /**
     * Returns an array of bundles to register.
     *
     * @return BundleInterface[] An array of bundle instances.
     *
     * @api
     */
    public function registerBundles()
    {
        $bundles = array(
            new FrameworkBundle(),
            new TwigBundle(),
            new ALSwaggerUIBundle(),
        );

        return $bundles;
    }

    /**
     * Loads the container configuration.
     *
     * @param LoaderInterface $loader A LoaderInterface instance
     *
     * @api
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config_' . $this->environment . '.yml');
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir() . '/al_swagger_ui/' . Kernel::VERSION . '/cache/' . $this->environment;
    }

    public function getLogDir()
    {
        return sys_get_temp_dir() . '/al_swagger_ui/' . Kernel::VERSION . '/logs';
    }
}