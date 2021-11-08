<?php

namespace ContainerRvtbzIf;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getMemberControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\MemberController' shared autowired service.
     *
     * @return \App\Controller\MemberController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/framework-bundle/Controller/AbstractController.php';
        include_once \dirname(__DIR__, 4).'/src/Controller/MemberController.php';

        $container->services['App\\Controller\\MemberController'] = $instance = new \App\Controller\MemberController();

        $instance->setContainer(($container->privates['.service_locator.W9y3dzm'] ?? $container->load('get_ServiceLocator_W9y3dzmService'))->withContext('App\\Controller\\MemberController', $container));

        return $instance;
    }
}
