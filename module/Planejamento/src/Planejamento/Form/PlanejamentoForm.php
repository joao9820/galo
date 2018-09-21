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

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_problema")->required(true)->label("Nome do problema");
        $objForm->text("nm_recurso")->required(true)->label("Recurso");
        $objForm->text("nm_tom_campanha")->required(true)->label("Tom da Campanha");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}