<?php

namespace Planejamento\Table;

use Estrutura\Table\AbstractEstruturaTable;

class PlanejamentoTable extends AbstractEstruturaTable{

    public $table = 'planejamento';
    public $campos = [

        'id_planejamento'  => 'id',
        'nm_problema' => 'nm_problema',
        'nm_recurso' => 'nm_recurso',
        'tx_analise_swot' => 'tx_analise_swot',
        'nm_avaliacao' => 'nm_avaliacao',
        'nm_acao' => 'nm_atendente',
        'nm_estrategia' => 'nm_atendente',
        'nm_abordagem' => 'nm_atendente',
        'nm_slogan' => 'nm_atendente',
        'nm_tom_campanha' => 'nm_atendente',
        'tx_peca' => 'nm_atendente',
        'ar_arquivo' => 'nm_atendente',
        'id_solicitacao' => 'nm_atendente',
        'id_cronograma' => 'nm_atendente',

    ];

}