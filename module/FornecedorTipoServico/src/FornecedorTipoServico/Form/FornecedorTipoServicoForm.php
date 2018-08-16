<?php

namespace FornecedorTipoServico\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class FornecedorTipoServicoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('fornecedortiposervicoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('fornecedortiposervicoform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}