<?php

namespace Atendimento\Entity;

use Estrutura\Service\AbstractEstruturaService;

class AtendimentoEntity extends AbstractEstruturaService{

    protected $id;
    protected $nm_atendente;
    protected $nm_supervisor;
    protected $nm_diretor_arte;
    protected $nm_redator;
    protected $tx_objetivo;
    protected $nr_sla_atendimento;
    protected $nm_target;
    protected $nm_conceito;
    protected $nm_verba_estimada;
    protected $ar_arquivo;
    protected $tx_informacao_complementar;
    protected $id_solicitacao;


}