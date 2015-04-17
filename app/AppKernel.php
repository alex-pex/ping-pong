<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // symfony-standard bundles
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),

            // extra bundles
            new OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Ivan1986\SupervisorBundle\SupervisorBundle(),
            new Phobetor\RabbitMqSupervisorBundle\RabbitMqSupervisorBundle(),

            // app bundle
            new AppBundle\AppBundle(),
        );

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
