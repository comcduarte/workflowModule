<?php 
namespace Workflow\Model;

use Midnet\Model\DatabaseObject;

class WorkflowModel extends DatabaseObject
{
    public $CODE;
    public $TITLE;
    public $STATE;
    public $DESCRIPTION;
    
    public function __construct($dbAdapter = NULL)
    {
        parent::__construct($dbAdapter);
        
        $this->setTableName('workflows');
        $this->setPrimaryKey('UUID');
    }
}