<?php
namespace Workflow\Form;

use Midnet\Form\AbstractBaseForm;
use Midnet\Form\Element\DatabaseSelectObject;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;

class WorkflowForm extends AbstractBaseForm
{
    use AdapterAwareTrait;
    
    public function initialize()
    {
        parent::initialize();
        
        $this->add([
            'name' => 'CODE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'CODE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Code',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'TITLE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'TITLE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Title',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'DESCRIPTION',
            'type' => Textarea::class,
            'attributes' => [
                'id' => 'DESCRIPTION',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Description',
            ],
        ],['priority' => 100]);
        
        $this->add([
            'name' => 'STATE',
            'type' => DatabaseSelectObject::class,
            'attributes' => [
                'id' => 'STATE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'State',
                'database_adapter' => $this->adapter,
                'database_table' => 'workflow-states',
                'database_id_column' => 'UUID',
                'database_value_column' => 'STATE',
            ],
        ],['priority' => 100]);
    }
}