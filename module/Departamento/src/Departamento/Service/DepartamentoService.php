<?php

namespace Departamento\Service;

use \Departamento\Entity\DepartamentoEntity as Entity;

class DepartamentoService extends Entity{

    public function getDepartamentoToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('departamento')
            ->where([
                'departamento.id_departamento = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getDepartamentoPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('departamento')->columns([
            'id_departamento',
            'nm_departamento',
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

        $select->where($where)->order(['nm_departamento ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarDepartamentoPorNomeToArray($nm_departamento) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('departamento')
            ->columns(array('id_departamento', 'nm_departamento')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "departamento.nm_departamento LIKE ?" => '%' . $nm_departamento . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdDepartamentoPorNomeToArray($nm_departamento) {

        $arNomeDepartamento = explode('(', $nm_departamento);
        $nm_departamento = $arNomeDepartamento[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('departamento')
            ->columns(array('id_departamento', 'nm_departamento'))
            ->where([
                'departamento.nm_departamento = ?' => $filter->filter($nm_departamento),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}