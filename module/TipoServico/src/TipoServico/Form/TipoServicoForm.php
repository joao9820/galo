<?php

namespace TipoServico\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class TipoServicoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('tiposervicoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('tiposervicoform',$this,$this->inputFilter);

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_tipo_servico")->required(true)->label("Nome do tipo de Serviço");

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}