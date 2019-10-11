<?php
namespace Workflow\Controller\Factory;

use Interop\Container\ContainerInterface;
use Workflow\Controller\WorkflowMaintenanceController;
use Zend\ServiceManager\Factory\FactoryInterface;

class WorkflowMaintenanceControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new WorkflowMaintenanceController();
        
        $adapter = $container->get('workflow-model-primary-adapter');
        $controller->setDbAdapter($adapter);
        
        return $controller;
    }
}