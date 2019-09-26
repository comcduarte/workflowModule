<?php
namespace Workflow\Controller\Factory;

use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Workflow\Controller\WorkflowController;
use Workflow\Form\WorkflowForm;
use Workflow\Model\WorkflowModel;
use Zend\ServiceManager\Factory\FactoryInterface;

class WorkflowControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $controller = new WorkflowController();
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:i:s');
        
        $adapter = $container->get('workflow-model-primary-adapter');
        $controller->setDbAdapter($adapter);
        
        $model = new WorkflowModel($adapter);
        $model->UUID = $uuid->value;
        $model->DATE_CREATED = $today;
        $model->STATUS = $model::ACTIVE_STATUS;
        
        $controller->setModel($model);
        
        $form = $container->get('FormElementManager')->get(WorkflowForm::class);
        $controller->setForm($form);
        return $controller;
    }
}