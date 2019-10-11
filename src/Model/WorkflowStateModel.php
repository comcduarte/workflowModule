<?php
namespace Workflow\Model;

use Midnet\Model\DatabaseObject;

class WorkflowStateModel extends DatabaseObject
{
    public $STATE;
    
    public function __construct($adapter = NULL)
    {
        parent::__construct($adapter);
        
        $this->setTableName('workflow-states');
        $this->setPrimaryKey('UUID');
    }
}