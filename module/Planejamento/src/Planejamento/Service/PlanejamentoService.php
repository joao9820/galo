<?php

namespace Planejamento\Service;

use \Planejamento\Entity\PlanejamentoEntity as Entity;

class PlanejamentoService extends Entity{

    public function getPlanejamentoToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('planejamento')
            ->where([
                'planejamento.id_planejamento = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getPlanejamentoPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('planejamento')->columns([
            'id_planejamento',
            'nm_problema',
            'nm_recurso',
            'nm_tom_campanha',
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

        $select->where($where)->order(['id_planejamento DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarPlanejamentoPorNomeToArray($nm_planejamento) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('planejamento')
            ->columns(array('id_planejamento', 'nm_problema')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "planejamento.nm_problema LIKE ?" => '%' . $nm_planejamento . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdPlanejamentoPorNomeToArray($nm_planejamento) {

        $arNomePlanejamento = explode('(', $nm_planejamento);
        $nm_planejamento = $arNomePlanejamento[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('planejamento')
            ->columns(array('id_planejamento', 'nm_problema'))
            ->where([
                'planejamento.nm_problema = ?' => $filter->filter($nm_planejamento),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }
}