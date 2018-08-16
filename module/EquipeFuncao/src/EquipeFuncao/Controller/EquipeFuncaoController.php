<?php

namespace EquipeFuncao\Controller;

use Estrutura\Controller\AbstractCrudController;

class EquipeFuncaoController extends AbstractCrudController
{
    /**
     * @var \EquipeFuncao\Service\EquipeFuncao
     */
    protected $service;

    /**
     * @var \EquipeFuncao\Form\EquipeFuncao
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
