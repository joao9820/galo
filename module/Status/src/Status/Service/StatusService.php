<?php

namespace Status\Service;

use \Status\Entity\StatusEntity as Entity;

class StatusService extends Entity{

    public function getStatusToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('status')
            ->where([
                'status.id_status = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getStatusPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('status')->columns([
            'id_status',
            'nm_status',
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

        $select->where($where)->order(['id_status DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarStatusPorNomeToArray($nm_status) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('status')
            ->columns(array('id_status', 'nm_status')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "status.nm_status LIKE ?" => '%' . $nm_status . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdStatusPorNomeToArray($nm_status) {

        $arNomeStatus = explode('(', $nm_status);
        $nm_status = $arNomeStatus[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('status')
            ->columns(array('id_status', 'nm_status'))
            ->where([
                'status.nm_status = ?' => $filter->filter($nm_status),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}