<?php

namespace Status\Table;

use Estrutura\Table\AbstractEstruturaTable;

class StatusTable extends AbstractEstruturaTable{

    public $table = 'status';
    public $campos = [

        'id_status' => 'id',
        'nm_status' => 'nm_status',

    ];

}