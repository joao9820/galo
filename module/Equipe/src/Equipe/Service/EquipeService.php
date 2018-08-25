<?php

namespace Equipe\Service;

use \Equipe\Entity\EquipeEntity as Entity;

class EquipeService extends Entity{

    public function getEquipeToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('equipe')
            ->where([
                'equipe.id_equipe = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getEquipePaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('equipe')->columns([
            'id_equipe',
            'nm_responsavel',
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

        $select->where($where)->order(['nm_responsavel ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarEquipePorNomeToArray($nm_equipe) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('equipe')
            ->columns(array('id_equipe', 'nm_responsavel')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "equipe.nm_responsavel LIKE ?" => '%' . $nm_equipe . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdEquipePorNomeToArray($nm_equipe) {

        $arNomeEquipe = explode('(', $nm_equipe);
        $nm_equipe = $arNomeEquipe[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('equipe')
            ->columns(array('nm_equipe', 'nm_responsavel'))
            ->where([
                'equipe.nm_responsavel = ?' => $filter->filter($nm_equipe),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}