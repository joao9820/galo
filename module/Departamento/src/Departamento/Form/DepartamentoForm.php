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

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_departamento")->required(true)->label("Nome do Departamento");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}