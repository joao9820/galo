<?php

namespace Atendimento\Service;

use \Atendimento\Entity\AtendimentoEntity as Entity;

class AtendimentoService extends Entity{

    public function getAtendimentoToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('atendimento')
            ->where([
                'atendimento.id_atendente = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getAtendimentoPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('atendimento')->columns([
            'id_atendimento',
            'nm_atendente',
            'nm_diretor_arte',
            'nm_redator',
            //'id_solicitacao',

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

        $select->where($where)->order(['id_atendimento DESC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarAtendimentoPorNomeToArray($nm_atendente) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('atendimento')
            ->columns(array('nm_atendente')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "atendimento.nm_atendente LIKE ?" => '%' . $nm_atendente . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdAtendimentoPorNomeToArray($nm_atendente) {

        $arNomeAtendente = explode('(', $nm_atendente);
        $nm_atendente = $arNomeAtendente[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('atendimento')
            ->columns(array('id_atendimento', 'nm_atendente'))
            ->where([
                'atendimento.nm_atendente = ?' => $filter->filter($nm_atendente),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}