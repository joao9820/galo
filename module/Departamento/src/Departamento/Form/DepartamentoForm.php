<?php

namespace Departamento\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class DepartamentoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('departamentoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('departamentoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}