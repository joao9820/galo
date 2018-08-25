<?php

namespace Funcao\Controller;

use Estrutura\Controller\AbstractCrudController;
use Estrutura\Helpers\Cript;
use Zend\View\Model\ViewModel;

class FuncaoController extends AbstractCrudController
{
    /**
     * @var \Funcao\Service\Funcao
     */
    protected $service;

    /**
     * @var \Funcao\Form\Funcao
     */
    protected $form;

    public function __construct(){
        parent::init();
    }

    public function indexAction()
    {
        return new ViewModel([
            'service' => $this->service,
            'form' => $this->form,
            'controller' => $this->params('controller'),
            'atributos' => array()
        ]);
    }

    public function indexPaginationAction()
    {
        $filter = $this->getFilterPage();

        $camposFilter = [
            '0' => NULL,
            '1' => [
                'filter' => "funcao.nm_funcao LIKE ?",
            ],
            '2' => NULL,
        ];


        $paginator = $this->service->getFuncaoPaginator($filter, $camposFilter);

        $paginator->setItemCountPerPage($paginator->getTotalItemCount());

        $countPerPage = $this->getCountPerPage(
            current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
        );

        $paginator->setItemCountPerPage($this->getCountPerPage(
            current(\Estrutura\Helpers\Pagination::getCountPerPage($paginator->getTotalItemCount()))
        ))->setCurrentPageNumber($this->getCurrentPage());

        $viewModel = new ViewModel([
            'service' => $this->service,
            'form' => $this->form,
            'paginator' => $paginator,
            'filter' => $filter,
            'countPerPage' => $countPerPage,
            'camposFilter' => $camposFilter,
            'controller' => $this->params('controller'),
            'atributos' => array()
        ]);

        return $viewModel->setTerminal(TRUE);
    }

    public function gravarAction(){
        $this->addSuccessMessage('Registro gravado com sucesso');
        $this->redirect()->toRoute('navegacao', array('controller' => 'funcao-funcao', 'action' => 'index'));
        return parent::gravar($this->service, $this->form);
    }

    public function cadastroAction()
    {
        return parent::cadastro($this->service, $this->form);
    }

    public function excluirAction()
    {
        return parent::excluir($this->service, $this->form);
    }
}
