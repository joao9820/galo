<?php

namespace Unidade\Table;

use Estrutura\Table\AbstractEstruturaTable;

class UnidadeTable extends AbstractEstruturaTable{

    public $table = 'unidade';
    public $campos = [

        'id_unidade' => 'id',
        'nm_unidade' => 'nm_unidade',

    ];

}