<?php 

use Workflow\Controller\IndexController;
use Workflow\Controller\IndexControllerFactory;

return [
    'controllers' => [
        'factories' => [
            IndexController::class => IndexControllerFactory::class,
        ],
    ],
    'navigation' => [
        'default' => [
            [
                'label' => 'Workflow',
                'route' => 'home',
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