<?php 

use Workflow\Controller\IndexController;
use Workflow\Controller\WorkflowController;
use Workflow\Controller\Factory\IndexControllerFactory;
use Workflow\Controller\Factory\WorkflowControllerFactory;
use Workflow\Form\WorkflowForm;
use Workflow\Form\Factory\WorkflowFormFactory;
use Workflow\Service\Factory\WorkflowModelPrimaryAdapterFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

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
            IndexController::class => IndexControllerFactory::class,
            WorkflowController::class => WorkflowControllerFactory::class,
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
                        'label' => 'Create new Workflow',
                        'route' => 'workflows/default',
                        'action' => 'create',
                    ],
                ],
            ]
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