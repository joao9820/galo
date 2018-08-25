<?php

namespace Unidade\Service;

use \Unidade\Entity\UnidadeEntity as Entity;

class UnidadeService extends Entity{

    public function getUnidadeToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('unidade')
            ->where([
                'unidade.id_unidade = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getUnidadePaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('unidade')->columns([
            'id_unidade',
            'nm_unidade',
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

        $select->where($where)->order(['id_unidade ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarUnidadePorNomeToArray($nm_unidade) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('unidade')
            ->columns(array('id_unidade', 'nm_unidade')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "unidade.nm_unidade LIKE ?" => '%' . $nm_unidade . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdUnidadePorNomeToArray($nm_unidade) {

        $arNomeUnidade = explode('(', $nm_unidade);
        $nm_unidade = $arNomeUnidade[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('unidade')
            ->columns(array('id_unidade', 'nm_unidade'))
            ->where([
                'unidade.nm_unidade = ?' => $filter->filter($nm_unidade),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}