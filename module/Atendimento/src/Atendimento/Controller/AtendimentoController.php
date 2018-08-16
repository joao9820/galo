<?php

namespace Atendimento\Controller;

use Estrutura\Controller\AbstractCrudController;

class AtendimentoController extends AbstractCrudController
{
    /**
     * @var \Atendimento\Service\Atendimento
     */
    protected $service;

    /**
     * @var \Atendimento\Form\Atendimento
     */
    protected $form;

    public function __construct(){
        parent::init();
    }

    public function indexAction()
    {
        return parent::index($this->service, $this->form);
    }

    public function gravarAction(){
        return parent::gravar($this->service, $this->form);
    }

    public function cadastroAction()
    {
        
        if ($result = parent::gravar($this->service, $this->form);) {
            
            $this->addSuccessMessage('Registro salvo com sucesso!');
            $this->redirect()->toRoute('navegacao', array(
                'controller' => $controller, 
                'action' => 'index')
            );
        }
        return $result;
    }

    public function excluirAction()
    {
        return parent::excluir($this->service, $this->form);
    }
}
