<?php

namespace Solicitacao\Form;

use Estrutura\Form\AbstractForm;
use Estrutura\Form\FormObject;
use Zend\InputFilter\InputFilter;

class SolicitacaoForm extends AbstractForm{
    public function __construct($options=[]){
        parent::__construct('solicitacaoform');

        $this->inputFilter = new InputFilter();
        $objForm = new FormObject('solicitacaoform',$this,$this->inputFilter);

        $objForm->hidden("id")->required(false)->label("Id");
        $objForm->text("nm_solicitante")->required(true)->label("Nome do Responsável");

        //##############----BUSCANDO CAMPOS-- ####################
        $objForm->combo("id_usuario", '\Usuario\Service\UsuarioService', 'id', 'nm_usuario')->required(false)->label("Usuario");
        $objForm->combo("id_unidade", '\Unidade\Service\UnidadeService', 'id', 'nm_unidade')->required(false)->label("*Unidade");
        $objForm->combo("id_departamento", '\Departamento\Service\DepartamentoService', 'id', 'nm_departamento')->required(false)->label("*Departamento");
        $objForm->email("em_email")->required(true)->label("*E-mail");

        $objForm->email("em_email")->required(true)->label("*E-mail");
        $objForm->email("em_email_confirm")->required(true)->label("*Confirme o E-mail")
            ->setAttribute('data-match', '#em_email')
            ->setAttribute('data-match-error', 'E-mails não correspondem');
        $objForm->combo("id_email", '\Email\Service\EmailService', 'id', 'em_email')->required(false)->label("*Email");

        $objForm->textarea("tx_informacao")->required(true)->label("Detalhamento da Necessidade");

        #FK- Telefone Residencial
        $objForm->hidden("id_telefone_residencial")->required(false);
        $objForm->telefone("telefone_residencial")->setAttribute('class', 'telefone')->required(false)->label("*Telefone Fixo");
        #FK- Telefone Celular
        $objForm->text("telefone_celular")->setAttribute('class', 'celular')->required(false)->label("*Telefone Celular");
        $objForm->hidden("id_telefone_celular")->required(false);
        $objForm->text("nm_usuario")->required(true)->label("Usuário");






        $this->formObject = $objForm;
    }

    public function getInputFilter()
    {
        return $this->inputFilter;
    }
}