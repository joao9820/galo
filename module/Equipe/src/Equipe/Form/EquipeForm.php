<?php

namespace Equipe\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class EquipeForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('equipeform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('equipeform',$this,$this->inputFilter);

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_responsavel")->required(true)->label("Nome do Membro");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}