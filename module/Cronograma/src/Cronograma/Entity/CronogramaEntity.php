<?php

namespace Cronograma\Entity;

use Estrutura\Service\AbstractEstruturaService;

class CronogramaEntity extends AbstractEstruturaService{

    protected $id;
    protected $nm_acao;
    protected $dt_data_inicio;
    protected $dt_data_fim;
    protected $id_equipe;
    protected $ar_arquivo;

}