<?php

namespace Atendimento\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class AtendimentoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('atendimentoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('atendimentoform',$this,$this->inputFilter);

        $objForm->text("nm_atendente")->required(true)->label("Nome do Atendente");
        $objForm->text("nm_diretor_arte")->required(true)->label("Nome do Diretor de Arte");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}