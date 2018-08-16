<?php

namespace Unidade\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class UnidadeForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('unidadeform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('unidadeform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}