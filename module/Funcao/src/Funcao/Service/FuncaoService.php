<?php

namespace Funcao\Service;

use \Funcao\Entity\FuncaoEntity as Entity;

class FuncaoService extends Entity{

    public function getFuncaoToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('funcao')
            ->where([
                'funcao.id_funcao = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getFuncaoPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('funcao')->columns([
            'id_funcao',
            'nm_funcao',
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

        $select->where($where)->order(['nm_funcao DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarFuncaoPorNomeToArray($nm_funcao) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('funcao')
            ->columns(array('id_funcao', 'nm_funcao')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "funcao.nm_funcao LIKE ?" => '%' . $nm_funcao . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdFuncaoPorNomeToArray($nm_funcao) {

        $arNomeFuncao = explode('(', $nm_funcao);
        $nm_funcao = $arNomeFuncao[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('funcao')
            ->columns(array('id_funcao', 'nm_funcao'))
            ->where([
                'funcao.nm_funcao = ?' => $filter->filter($nm_funcao),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}