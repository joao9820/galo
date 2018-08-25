<?php

namespace TipoServico\Service;

use \TipoServico\Entity\TipoServicoEntity as Entity;

class TipoServicoService extends Entity{

    public function getTipoServicoToArray($id) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('tipo_servico')
            ->where([
                'tipo_servico.id_tipo_servico = ?' => $id,
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

    public function getTipoServicoPaginator($filter = NULL, $camposFilter = NULL) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('tipo_servico')->columns([
            'id_tipo_servico',
            'nm_tipo_servico',
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

        $select->where($where)->order(['nm_tipo_servico ASC']);

        return new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\DbSelect($select, $this->getAdapter()));
    }

    public function getFiltrarServicoPorNomeToArray($nm_tipo_servico) {

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());

        $select = $sql->select('tipo_servico')
            ->columns(array('id_tipo_servico', 'nm_tipo_servico')) #Colunas a retornar. Basta Omitir que ele traz todas as colunas
            ->where([
                "tipo_servico.nm_tipo_servico LIKE ?" => '%' . $nm_tipo_servico . '%',
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute();
    }

    public function getIdTipoServicoPorNomeToArray($nm_tipo_servico) {

        $arNomeTipoServico = explode('(', $nm_tipo_servico);
        $nm_tipo_servico = $arNomeTipoServico[0];

        $sql = new \Zend\Db\Sql\Sql($this->getAdapter());
        $filter = new \Zend\Filter\StringTrim();
        $select = $sql->select('tipo_servico')
            ->columns(array('id_tipo_servico', 'nm_tipo_servico'))
            ->where([
                'tipo_servico.nm_tipo_servico = ?' => $filter->filter($nm_tipo_servico),
            ]);

        return $sql->prepareStatementForSqlObject($select)->execute()->current();
    }

}