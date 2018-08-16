<?php

namespace Cidade\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class CidadeForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('cidadeform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('cidadeform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}