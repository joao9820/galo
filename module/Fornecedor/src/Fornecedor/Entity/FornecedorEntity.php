<?php

namespace Fornecedor\Entity;

use Estrutura\Service\AbstractEstruturaService;

class FornecedorEntity extends AbstractEstruturaService{

    protected $id;
    protected $nm_fornecedor;
    protected $nm_contato_fornecedor;
    protected $nr_CNPJ;
    protected $nr_inscr_estadual;
    protected $nm_website;
    protected $id_telefone_fixo;
    protected $id_telefone_celular;
    protected $id_email;
    protected $id_endereco;

}