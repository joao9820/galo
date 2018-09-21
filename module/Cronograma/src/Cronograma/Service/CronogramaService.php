<?php

namespace Cronograma\Service;

use \Cronograma\Entity\CronogramaEntity as Entity;

class CronogramaService extends Entity{

    public function getCronogramaToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('cronograma')
            ->where([
                'cronograma.id_cronograma = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getCronogramaPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('cronograma')->columns([
            'id_cronograma',
            'nm_acao',
        ]);

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

        $select->where($where)->order(['nm_acao ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarCronogramaPorNomeToArray($nm_acao) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('cronograma')
            ->columns(array('id_cronograma', 'nm_acao')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "cronograma.nm_acao LIKE ?" => '%' . $nm_acao . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdCronogramaPorNomeToArray($nm_acao) {

        $arNomeAcao = explode('(', $nm_acao);
        $nm_acao = $arNomeAcao[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('cronograma')
            ->columns(array('id_cronograma', 'nm_acao'))
            ->where([
                'cronograma.nm_acao = ?' => $filter->filter($nm_acao),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}