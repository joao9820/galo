<?php

return array(
    'router' => array(
        'routes' => array(
            'solicitacao_tipo_servico-home' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/solicitacao_tipo_servico',
                    'defaults' => array(
                        'controller' => 'solicitacao_tipo_servico',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'solicitacao_tipo_servico' => 'SolicitacaoTipoServico\Controller\SolicitacaoTipoServicoController',
            'solicitacao_tipo_servico-solicitacaotiposervico' => 'Solicitacao_tipo_servico\Controller\SolicitacaotiposervicoController',

        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
);
