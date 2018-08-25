<?php

namespace Cronograma\Table;

use Estrutura\Table\AbstractEstruturaTable;

class CronogramaTable extends AbstractEstruturaTable{

    public $table = 'cronograma';
    public $campos = [

        'id_cronograma'  => 'id',
        'nm_acao' => 'nm_acao',
        'dt_data_inicio' => 'dt_data_inicio',
        'dt_data_fim' => 'dt_data_fim',
        'id_equipe' => 'id_equipe',
        'ar_arquivo' => 'ar_arquivo',

    ];

}