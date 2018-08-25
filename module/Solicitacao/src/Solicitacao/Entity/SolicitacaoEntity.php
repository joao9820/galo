<?php

namespace Solicitacao\Entity;

use Estrutura\Service\AbstractEstruturaService;

class SolicitacaoEntity extends AbstractEstruturaService{

    protected $id;
    protected $nm_solicitante;
    protected $id_telefone_fixo;
    protected $id_telefone_celular;
    protected $id_email;
    protected $id_departamento;
    protected $id_usuario_cadastro;
    protected $id_status;
    protected $id_unidade;
    protected $dt_data_criacao;
    protected $dt_data_final_atendimento;
    protected $tx_informacao;
    protected $nr_controle;

}