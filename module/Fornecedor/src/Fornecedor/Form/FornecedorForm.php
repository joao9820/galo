<?php

namespace Fornecedor\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class FornecedorForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('fornecedorform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('fornecedorform',$this,$this->inputFilter);

        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}