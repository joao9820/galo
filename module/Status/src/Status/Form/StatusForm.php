<?php

namespace Status\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class StatusForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('statusform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('statusform',$this,$this->inputFilter);

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_status")->required(true)->label("Nome do Status");


        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}