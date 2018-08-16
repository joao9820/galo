<?php

namespace Planejamento\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class PlanejamentoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('planejamentoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('planejamentoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}