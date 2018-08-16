<?php

namespace TipoServico\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class TipoServicoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('tiposervicoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('tiposervicoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}