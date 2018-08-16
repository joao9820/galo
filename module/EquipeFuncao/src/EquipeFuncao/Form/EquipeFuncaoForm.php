<?php

namespace EquipeFuncao\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class EquipeFuncaoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('equipefuncaoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('equipefuncaoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}