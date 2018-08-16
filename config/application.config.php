<?php

return array(
    'modules' => array(
        'Application',
        'Auth',
        'Estrutura', //Tem que vir antes dos demais módulos
        'Principal',
        'Email',
        'Usuario',
        'Perfil',
        'EsqueciSenha',
        'Controller',
        'Action',
        'Config',
        'Gerador',
        'Sexo',
        'TipoUsuario',
        'SituacaoUsuario',
        'CompactAsset',
        'EdpSuperluminal',
        'CompactAsset', //Compacta o Javascript e CSS para retornar em apenas uma requisição (Responsável pela minificar o css e js: compila os arquivos em um só)
        #'ContaBancaria',
        'DOMPDFModule',
        //Ronaldo 02/03/2016 - Responsável por melhorar o desempenho da aplicação
        'EdpSuperluminal', //http://dev.galo.com.br/?EDPSUPERLUMINAL_CACHE - Execute isso na URL para compilar os arquivos e ficar mais rapido - em cada requisição, em vês de baixar em tempo de execução cada require do autoload, ele salva um unico arquivo, minificado, com todas as classes dentro
        'Gerador',
        'Login',
        'Situacao',
        'Telefone',
        'TipoTelefone',
        'Permissao',
        'PerfilControllerAction',
        'Infra',
        'Pesquisar',
        'Atendimento',
        'Cronograma',
        'Departamento',
        'Equipe',
        'EquipeFuncao',
        'Cidade',
        'Endereco',
        'Estado',
        'Fornecedor',
        'FornecedorTipoServico',
        'Funcao',
        'Planejamento',
        'Solicitacao',
        'SolicitacaoTipoServico',
        'Status',
        'TipoServico',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,' . APPLICATION_ENV . '}.php'
        ),
    )
);
