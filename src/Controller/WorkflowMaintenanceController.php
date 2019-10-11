<?php
namespace Workflow\Controller;

use Midnet\Controller\AbstractBaseController;
use Midnet\Model\Uuid;
use Zend\View\Model\ViewModel;

class WorkflowMaintenanceController extends AbstractBaseController
{
    private function initialize()
    {
        $uuid = new Uuid();
        $date = new \DateTime('now',new \DateTimeZone('EDT'));
        $today = $date->format('Y-m-d H:i:s');
        
        $model_name = 'Workflow\\Model\\' . $this->params()->fromRoute('model');
        $model = new $model_name($this->adapter);
        
        $model->UUID = $uuid->value;
        $model->DATE_CREATED = $today;
        $model->STATUS = $model::ACTIVE_STATUS;
        
        $this->setModel($model);
        
        $form_name = $this->params()->fromRoute('form');
        $form = new $form_name($uuid->generate()->value);
        
        $form->setInputFilter($model->getInputFilter());
        $form->setDbAdapter($this->adapter);
        $form->initialize();
        
        $this->setForm($form);
    }
    
    public function indexAction()
    {
        $this->initialize();
        
        $view = new ViewModel();
        $view->setTemplate('workflow/workflow-maintenance/index.phtml');
//         $view->setVariable('indexViewRoute', 'districts/default');
        $view = parent::indexAction();
        return ($view);
    }
    
    public function createAction()
    {
        $this->initialize();
        
        $view = new ViewModel();
        $view->setTemplate('workflow/workflow-maintenance/create.phtml');
        //         $view->setVariable('indexViewRoute', 'districts/default');
        $view = parent::createAction();
        return ($view);
    }
    
    public function updateAction()
    {
        $this->initialize();
        
        $view = new ViewModel();
        $view->setTemplate('workflow/workflow-maintenance/update.phtml');
        //         $view->setVariable('indexViewRoute', 'districts/default');
        $view = parent::updateAction();
        return ($view);
    }
}