<?php

namespace Atendimento\Table;

use Estrutura\Table\AbstractEstruturaTable;

class AtendimentoTable extends AbstractEstruturaTable{

    public $table = 'atendimento';
    public $campos = [

        'id_atendimento'  => 'id',
        'nm_atendente' => 'nm_atendente',
        'nm_supervisor' => 'nm_supervisor',
        'nm_diretor_arte' => 'nm_diretor_arte',
        'nm_redator' => 'nm_redator',
        'tx_objetivo' => 'tx_objetivo',
        'nr_sla_atendimento' => 'nr_sla_atendimento',
        'nm_target' => 'nm_target',
        'nm_conceito' => 'nm_conceito',
        'nm_verba_estimada' => 'nm_verba_estimada',
        'ar_arquivo' => 'ar_arquivo',
        'tx_informacao_complementar' => 'tx_informacao_complementar',
        'id_solicitacao' => 'id_solicitacao',

    ];

}