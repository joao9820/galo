<?php

namespace Fornecedor\Table;

use Estrutura\Table\AbstractEstruturaTable;

class FornecedorTable extends AbstractEstruturaTable{

    public $table = 'fornecedor';
    public $campos = [

        'id_fornecedor'  => 'id',
        'nm_fornecedor' => 'nm_fornecedor',
        'nm_contato_fornecedor' => 'nm_contato_fornecedor',
        'nr_CNPJ' => 'nr_CNPJ',
        'nr_inscr_estadual' => 'nr_inscr_estadual',
        'nm_website' => 'nm_website',
        'id_telefone_fixo' => 'id_telefone_fixo',
        'id_telefone_celular' => 'id_telefone_celular',
        'id_email' => 'id_email',
        'id_endereco' => 'id_endereco',

    ];

}