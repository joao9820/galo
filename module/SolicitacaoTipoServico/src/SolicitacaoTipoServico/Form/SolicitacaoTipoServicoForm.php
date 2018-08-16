<?php

namespace SolicitacaoTipoServico\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class SolicitacaoTipoServicoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('solicitacaotiposervicoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('solicitacaotiposervicoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}