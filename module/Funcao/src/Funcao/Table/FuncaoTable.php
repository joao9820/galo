<?php

namespace Funcao\Table;

use Estrutura\Table\AbstractEstruturaTable;

class FuncaoTable extends AbstractEstruturaTable{

    public $table = 'funcao';
    public $campos = [

        'id_funcao'  => 'id',
        'nm_funcao' => 'nm_funcao',

    ];

}