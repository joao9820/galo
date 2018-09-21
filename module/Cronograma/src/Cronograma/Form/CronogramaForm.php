<?php

namespace Cronograma\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class CronogramaForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('cronogramaform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('cronogramaform',$this,$this->inputFilter);

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_acao")->required(true)->label("Nome da ação");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}