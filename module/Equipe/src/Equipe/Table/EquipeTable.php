<?php

namespace Equipe\Table;

use Estrutura\Table\AbstractEstruturaTable;

class EquipeTable extends AbstractEstruturaTable{

    public $table = 'equipe';
    public $campos = [

        'id_atendimento'  => 'id',
        'nm_responsavel' => 'nm_responsavel',

    ];

}