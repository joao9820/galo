<?php

namespace Estado\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class EstadoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('estadoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('estadoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}