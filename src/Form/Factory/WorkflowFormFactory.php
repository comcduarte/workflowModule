<?php
namespace Workflow\Form\Factory;

use Interop\Container\ContainerInterface;
use Midnet\Model\Uuid;
use Workflow\Form\WorkflowForm;
use Zend\ServiceManager\Factory\FactoryInterface;
use Workflow\Model\WorkflowModel;

class WorkflowFormFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $uuid = new Uuid();
        $form = new WorkflowForm($uuid->value);
        $model = new WorkflowModel();
        
        $form->setInputFilter($model->getInputFilter());
        $form->setDbAdapter($container->get('workflow-model-primary-adapter'));
        $form->initialize();
        return $form;
    }
}