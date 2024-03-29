<?php 
namespace Workflow\Model;

use Midnet\Model\DatabaseObject;

class WorkflowModel extends DatabaseObject
{
    public $CODE;
    public $TITLE;
    public $STATE;
    public $DESCRIPTION;
    
    public function __construct($adapter = NULL)
    {
        parent::__construct($adapter);
        
        $this->setTableName('workflows');
        $this->setPrimaryKey('UUID');
    }
}