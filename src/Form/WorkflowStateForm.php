<?php 
namespace Workflow\Form;

use Midnet\Form\AbstractBaseForm;
use Zend\Db\Adapter\AdapterAwareTrait;
use Zend\Form\Element\Text;

class WorkflowStateForm extends AbstractBaseForm
{
    use AdapterAwareTrait;
    
    public function initialize()
    {
        parent::initialize();
        
        $this->add([
            'name' => 'STATE',
            'type' => Text::class,
            'attributes' => [
                'id' => 'STATE',
                'class' => 'form-control',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Workflow State',
            ],
        ],['priority' => 100]);
    }
}