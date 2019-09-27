<?php
namespace Workflow\Controller\Factory;

use Interop\Container\ContainerInterface;
use Workflow\Controller\ConfigController;
use Zend\ServiceManager\Factory\FactoryInterface;

class ConfigControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new ConfigController();
        $controller->setDbAdapter($container->get('workflow-model-primary-adapter'));
        return $controller;
    }
}