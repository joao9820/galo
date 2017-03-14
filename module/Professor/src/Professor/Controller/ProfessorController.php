<?php

namespace Professor\Controller;

use DOMPDFModule\View\Model\PdfModel;
use Estrutura\Controller\AbstractCrudController;
use Estrutura\Helpers\Cript;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class ProfessorController extends AbstractCrudController
{

    protected $service;

    protected $form;

    public function __construct()
    {
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
            '0' => [
                'filter' => "professor.nm_professor LIKE ?",
            ],
            '1' => [
                'filter' => "titulacao.nm_titulacao LIKE ?",
            ],
            '2' => [
                'filter' => "titulacao.nm_titulacao LIKE ?",
            ],
            '3' => [
                'filter' => "professor.cs_orientador LIKE ?",
            ],
            '4' => [
                'filter' => "professor.cs_ativo LIKE ?",
            ],
            '5' => NULL,
        ];


        $paginator = $this->service->getProfessoresPaginator($filter, $camposFilter);

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

    public function gravarAction()
    {
        try {
            $controller = $this->params('controller');
            $request = $this->getRequest();
            $service = $this->service;
            $form = $this->form;

            if (!$request->isPost()) {
                throw new \Exception('Dados Inválidos');
            }

            $post = \Estrutura\Helpers\Utilities::arrayMapArray('trim', $request->getPost()->toArray());

            $files = $request->getFiles();
            $upload = $this->uploadFile($files);

            $post = array_merge($post, $upload);

            if (isset($post['id']) && $post['id']) {
                $post['id'] = Cript::dec($post['id']);
            }

            $form->setData($post);

            if (!$form->isValid()) {
                $this->addValidateMessages($form);
                $this->setPost($post);
                $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro'));
                return false;
            }

            $service->exchangeArray($form->getData());
            $this->addSuccessMessage('Registro Alterado com sucesso');
            $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'index'));
            return $service->salvar();

        } catch (\Exception $e) {

            $this->setPost($post);
            $this->addErrorMessage($e->getMessage());
            $this->redirect()->toRoute('navegacao', array('controller' => $controller, 'action' => 'cadastro'));
            return false;
        }
    }

    public function cadastroAction()
    {
        return parent::cadastro($this->service, $this->form);
    }

    public function excluirAction()
    {
        return parent::excluirProfessor($this->service, $this->form);
    }

    public function autocompleteprofessorAction()
    {
        $termo = $_GET['term'];
        $professores = new \Professor\Service\ProfessorService();
        $arrProfessores = $professores->getFiltrarProfessorPorNomeToArray($termo);
        $arrProfessoresFiltrados = array();
        foreach ($arrProfessores as $professor) {
            #if ($professor['cs_orientador'] == 'S') {
            #	$arrProfessoresFiltrados[] = $professor['nm_professor'] . ' (Orientador(a)) ';
            #} else if ($professor['cs_orientador'] == 'N') {
            #	$arrProfessoresFiltrados[] = $professor['nm_professor'] . ' (Professor(a)) ';
            #} else {
            $arrProfessoresFiltrados[] = $professor['nm_professor'];
            #}
        }

        $valuesJson = new JsonModel($arrProfessoresFiltrados);
        return $valuesJson;
    }

    public function gerarRelatorioPdfAction()
    {
        $catequizandoService = new \Professor\Service\ProfessorService();
        $arteste = $catequizandoService->fetchAll()->toArray();
        $pdf = new PdfModel();
        $pdf->setVariables(array(
            'caminho_imagem'=>__DIR__,
            'inicio_contador'=>3,
            'teste' => $arteste,

        ));
        $pdf->setOption('filename', 'ordem_serviço_'); // Triggers PDF download, automatically appends ".pdf"
        $pdf->setOption("paperSize", "a4"); //Defaults to 8x11
        $pdf->setOption("basePath", __DIR__); //Defaults to 8x11
        #$pdf->setOption("paperOrientation", "landscape"); //Defaults to portrait
        return $pdf;

    }

}
