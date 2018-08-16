<?php

namespace Solicitacao\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class SolicitacaoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('solicitacaoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('solicitacaoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}