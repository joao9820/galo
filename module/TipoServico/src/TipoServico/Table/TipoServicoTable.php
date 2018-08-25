<?php

namespace TipoServico\Table;

use Estrutura\Table\AbstractEstruturaTable;

class TipoServicoTable extends AbstractEstruturaTable{

    public $table = 'tipo_servico';
    public $campos = [

        'id_status' => 'id',
        'nm_tipo_servico' => 'nm_tipo_servico',

    ];

}