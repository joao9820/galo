<?php

namespace Solicitacao\Service;

use \Solicitacao\Entity\SolicitacaoEntity as Entity;

class SolicitacaoService extends Entity{

    public function getSolicitacaoToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('solicitacao')
            ->where([
                'solicitacao.id_solicitacao = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getSolicitacaoPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('solicitacao')->columns([
            'id_solicitacao',
            'nm_solicitante',
        ])
            ->join('unidade', 'unidade.id_unidade = solicitacao.id_unidade', ['nm_unidade'])
            ->join('status', 'status.id_status = solicitacao.id_status', ['nm_status'])
            ->join('departamento', 'departamento.id_departamento = solicitacao.id_departamento', ['nm_departamento']);

        $where = [
        ];

        if (!empty($filter)) {
            foreach ($filter as $key => $value) {
                if ($value) {
                    if (isset($camposFilter[$key]['mascara'])) {
                        eval("\$value = " . $camposFilter[$key]['mascara'] . ";");
                    }
                    $where[$camposFilter[$key]['filter']] = '%' . $value . '%';
                }
            }
        }

        $select->where($where)->order(['id_solicitacao DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarSolicitacaoPorNomeToArray($nm_solicitacao) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('solicitacao')
            ->columns(array('id_solicitacao', 'nm_solicitante')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "solicitacao.nm_solicitante LIKE ?" => '%' . $nm_solicitacao . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdSolicitacaoPorNomeToArray($nm_solicitacao) {

        $arNomeSolicitacao = explode('(', $nm_solicitacao);
        $nm_solicitacao = $arNomeSolicitacao[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('solicitacao')
            ->columns(array('id_solicitacao', 'nm_solicitante'))
            ->where([
                'solicitacao.nm_solicitante = ?' => $filter->filter($nm_solicitacao),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }
}