<?php 

use Workflow\Controller\ConfigController;
use Workflow\Controller\IndexController;
use Workflow\Controller\WorkflowController;
use Workflow\Controller\WorkflowMaintenanceController;
use Workflow\Controller\Factory\ConfigControllerFactory;
use Workflow\Controller\Factory\IndexControllerFactory;
use Workflow\Controller\Factory\WorkflowControllerFactory;
use Workflow\Controller\Factory\WorkflowMaintenanceControllerFactory;
use Workflow\Form\WorkflowForm;
use Workflow\Form\Factory\WorkflowFormFactory;
use Workflow\Service\Factory\WorkflowModelPrimaryAdapterFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Workflow\Form\WorkflowStateForm;

return [
    'router' => [
        'routes' => [
            'workflows' => [
                'type' => Literal::class,
                'priority' => 1,
                'options' => [
                    'route' => '/workflows',
                    'defaults' => [
                        'action' => 'index',
                        'controller' => WorkflowController::class,
                    ],
                ],
                'may_terminate' => FALSE,
                'child_routes' => [
                    'config' => [
                        'type' => Segment::class,
                        'priority' => 100,
                        'options' => [
                            'route' => '/config[/:action]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => ConfigController::class,
                            ],
                        ],
                    ],
                    'maintenance' => [
                        'type' => Segment::class,
                        'priority' => 90,
                        'options' => [
                            'route' => '/maintenance[/:action]',
                            'defaults' => [
                                'controller' => WorkflowMaintenanceController::class,
                            ],
                        ],
                        'child_routes' => [
                            'workflows' => [
                                'type' => Literal::class,
                                'priority' => 100,
                                'options' => [
                                    'route' => '/workflows',
                                    'defaults' => [
                                        'model' => WorkflowModel::class,
                                        'form' => WorkflowForm::class,
                                    ],
                                ],
                            ],
                            'workflow-states' => [
                                'type' => Literal::class,
                                'priority' => 100,
                                'options' => [
                                    'route' => '/workflow-states',
                                    'defaults' => [
                                        'model' => WorkflowStateModel::class,
                                        'form' => WorkflowStateForm::class,
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'default' => [
                        'type' => Segment::class,
                        'priority' => -100,
                        'options' => [
                            'route' => '/[:action[/:uuid]]',
                            'defaults' => [
                                'action' => 'index',
                                'controller' => WorkflowController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            ConfigController::class => ConfigControllerFactory::class,
            IndexController::class => IndexControllerFactory::class,
            WorkflowController::class => WorkflowControllerFactory::class,
            WorkflowMaintenanceController::class => WorkflowMaintenanceControllerFactory::class,
        ],
    ],
    'form_elements' => [
        'factories' => [
            WorkflowForm::class => WorkflowFormFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Workflow',
                'route' => 'home',
                'class' => 'dropdown',
                'pages' => [
                    [
                        'label' => 'Workflows',
                        'route' => 'workflows/default',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            [
                                'label' => 'Add Workflows',
                                'route' => 'workflows/maintenance/workflows',
                                'action' => 'create',
                            ],
                            [
                                'label' => 'View Workflows',
                                'route' => 'workflows/maintenance/workflows',
                                'action' => 'index',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Workflow States',
                        'route' => 'workflows/default',
                        'class' => 'dropdown-submenu',
                        'pages' => [
                            [
                                'label' => 'Add Workflow State',
                                'route' => 'workflows/maintenance/workflow-states',
                                'action' => 'create',
                            ],
                            [
                                'label' => 'View Workflow States',
                                'route' => 'workflows/maintenance/workflow-states',
                                'action' => 'index',
                            ],
                        ],
                    ],
                    [
                        'label' => 'Settings',
                        'route' => 'workflows/config',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            'workflow-model-primary-adapter-config' => 'model-primary-adapter-config',
        ],
        'factories' => [
            'workflow-model-primary-adapter' => WorkflowModelPrimaryAdapterFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];