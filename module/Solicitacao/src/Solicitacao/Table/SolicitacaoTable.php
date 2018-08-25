<?php

namespace Solicitacao\Table;

use Estrutura\Table\AbstractEstruturaTable;

class SolicitacaoTable extends AbstractEstruturaTable{

    public $table = 'solicitacao';
    public $campos = [

        'id_solicitacao' => 'id',
        'nm_solicitante' => 'nm_solicitante',
        'id_telefone_fixo' => 'id_telefone_fixo',
        'id_telefone_celular' => 'id_telefone_celular',
        'id_email' => 'id_email',
        'id_departamento' => 'id_departamento',
        'id_usuario_cadastro' => 'id_usuario_cadastro',
        'id_status' => 'id_status',
        'id_unidade' => 'id_unidade',
        'dt_data_criacao' => 'dt_data_criacao',
        'dt_data_final_atendimento' => 'dt_data_final_atendimento',
        'tx_informacao' => 'tx_informacao',
        'nr_controle' => 'nr_controle',
    ];

}