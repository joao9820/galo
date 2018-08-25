<?php

namespace Planejamento\Entity;

use Estrutura\Service\AbstractEstruturaService;

class PlanejamentoEntity extends AbstractEstruturaService{

    protected $id;
    protected $nm_problema;
    protected $nm_recurso;
    protected $tx_analise_swot;
    protected $nm_avaliacao;
    protected $nm_acao;
    protected $nm_estrategia;
    protected $nm_abordagem;
    protected $nm_slogan;
    protected $nm_tom_campanha;
    protected $tx_peca;
    protected $ar_arquivo;
    protected $id_solicitacao;
    protected $id_cronograma;

}