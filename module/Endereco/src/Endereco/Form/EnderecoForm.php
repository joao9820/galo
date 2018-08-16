<?php

namespace Endereco\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class EnderecoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('enderecoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('enderecoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}