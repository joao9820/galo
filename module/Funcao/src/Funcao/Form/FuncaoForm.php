<?php

namespace Funcao\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class FuncaoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('funcaoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('funcaoform',$this,$this->inputFilter);

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_funcao")->required(true)->label("Nome da Função");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}