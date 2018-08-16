/*==============================================================*/
/* Database name:  bdgalo                                       */
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     16/08/2018 16:01:49                          */
/*==============================================================*/


drop database if exists bdgalo;

/*==============================================================*/
/* Database: bdgalo                                             */
/*==============================================================*/
create database bdgalo;

use bdgalo;

/*==============================================================*/
/* Table: action                                                */
/*==============================================================*/
create table action
(
   id_action            int(11) not null auto_increment,
   nm_action            varchar(200) default NULL comment '{"label":"Ação"}',
   primary key (id_action)
)
ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: atendimento                                           */
/*==============================================================*/
create table atendimento
(
   id_atendimento       bigint not null,
   nm_atendente         varchar(150),
   nm_supervisor        varchar(150),
   nm_diretor_arte      varchar(150),
   nm_redator           varchar(150),
   tx_objetivo          text,
   nr_sla_atendimento   datetime,
   nm_target            varchar(150),
   nm_conceito          varchar(150),
   nm_verba_estimada    varchar(150),
   ar_arquivo           varchar(200),
   tx_informacao_complementar text,
   id_solicitacao       bigint,
   primary key (id_atendimento)
);

/*==============================================================*/
/* Table: cidade                                                */
/*==============================================================*/
create table cidade
(
   id_cidade            int(11) not null auto_increment,
   id_estado            int(11) not null,
   nm_cidade            varchar(150) default NULL comment '{"label":"Cidade"}',
   primary key (id_cidade),
   key ix_cidades_estados (id_estado)
)
ENGINE=InnoDB AUTO_INCREMENT=9715 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: config                                                */
/*==============================================================*/
create table config
(
   idconfigs            int(11) not null auto_increment,
   nm_config            varchar(200) default NULL comment '{"label":"Nome da Configuração"}',
   nm_valor             varchar(200) default NULL comment '{"label":"Valor"}',
   primary key (idconfigs)
)
ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: controller                                            */
/*==============================================================*/
create table controller
(
   id_controller        int(11) not null auto_increment,
   nm_controller        varchar(400) default NULL comment '{"label":"Controller"}',
   primary key (id_controller)
)
ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: cronograma                                            */
/*==============================================================*/
create table cronograma
(
   id_cronograma        bigint not null,
   nm_acao              varchar(150),
   dt_data_inicio       datetime,
   dt_data_fim          datetime,
   id_equipe            bigint,
   ar_arquivo           varchar(200),
   primary key (id_cronograma)
);

/*==============================================================*/
/* Table: departamento                                          */
/*==============================================================*/
create table departamento
(
   id_departamento      int(11) not null,
   nm_departamento      varchar(150),
   primary key (id_departamento)
);

/*==============================================================*/
/* Table: email                                                 */
/*==============================================================*/
create table email
(
   id_email             int(11) not null auto_increment,
   em_email             varchar(200) default NULL comment '{"label":"E-mail"}',
   id_situacao          int(11) not null,
   primary key (id_email),
   key ix_emails_situacao (id_situacao)
)
ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: endereco                                              */
/*==============================================================*/
create table endereco
(
   id_endereco          int(11) not null auto_increment,
   nm_logradouro        varchar(200) default NULL comment '{"label":"Logradouro"}',
   nr_numero            varchar(45) default NULL comment '{"label":"Número"}',
   nm_complemento       varchar(200) default NULL comment '{"label":"Complemento"}',
   nm_bairro            varchar(200) default NULL comment '{"label":"Bairro"}',
   nr_cep               varchar(8) default NULL comment '{"label":"Cep"}',
   id_cidade            int(11) not null,
   primary key (id_endereco),
   key ix_endereco_cidades (id_cidade)
)
ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: equipe                                                */
/*==============================================================*/
create table equipe
(
   id_equipe            bigint not null,
   nm_responsavel       varchar(150),
   primary key (id_equipe)
);

/*==============================================================*/
/* Table: equipe_funcao                                         */
/*==============================================================*/
create table equipe_funcao
(
   id_equipe_funcao     bigint not null,
   id_equipe            bigint,
   id_funcao            bigint,
   primary key (id_equipe_funcao)
);

/*==============================================================*/
/* Table: esqueci_senha                                         */
/*==============================================================*/
create table esqueci_senha
(
   id_esqueci_senha     int(11) not null auto_increment,
   id_usuario           int(11) default NULL,
   tx_identificacao     varchar(60) default NULL,
   id_situacao          int(11) default NULL,
   dt_solicitacao       datetime default NULL,
   dt_alteracao         datetime not null,
   primary key (id_esqueci_senha),
   key ix_esqueci_senha_usuarios (id_usuario),
   key ix_esqueci_senha_situacoes (id_situacao)
)
ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: estado                                                */
/*==============================================================*/
create table estado
(
   id_estado            int(11) not null auto_increment,
   nm_estado            varchar(150) default NULL comment '{"label":"Estado"}',
   sg_estado            char(2) default NULL,
   primary key (id_estado)
)
ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: fornecedor                                            */
/*==============================================================*/
create table fornecedor
(
   id_fornecedor        int(11) not null,
   nm_fornecedor        varchar(150),
   nm_contato_fornecedor varchar(150),
   nr_CNPJ              int(14),
   nr_inscr_estadual    int(11),
   nm_website           varchar(150),
   id_telefone_fixo     int(11),
   id_telefone_celular  int(11),
   id_email             int(11),
   id_endereco          int(11),
   primary key (id_fornecedor)
);

/*==============================================================*/
/* Table: fornecedor_tipo_servico                               */
/*==============================================================*/
create table fornecedor_tipo_servico
(
   id_fornecedor_tipo_servico int(11) not null,
   id_fornecedor        int(11),
   id_tipo_servico      int(11),
   primary key (id_fornecedor_tipo_servico)
);

/*==============================================================*/
/* Table: funcao                                                */
/*==============================================================*/
create table funcao
(
   id_funcao            bigint not null,
   nm_funcao            varchar(150),
   primary key (id_funcao)
);

/*==============================================================*/
/* Table: login                                                 */
/*==============================================================*/
create table login
(
   id_Login             int(11) not null auto_increment,
   pw_senha             varchar(40) default NULL comment '{"label":"Senha"}',
   nr_tentativas        int(11) default NULL comment '{"label":"Tentativas"}',
   dt_visita            datetime default NULL comment '{"label":"Data da última visita"}',
   dt_registro          datetime default NULL comment '{"label":"Data de Registro"}',
   id_usuario           int(11) not null,
   id_email             int(11) not null,
   id_situacao          int(11) not null,
   id_perfil            int(11) not null,
   primary key (id_Login),
   key ix_Login_usuarios (id_usuario),
   key ix_Login_emails (id_email),
   key ix_Login_situacao (id_situacao),
   key ix_Login_perfil (id_perfil)
)
ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: perfil                                                */
/*==============================================================*/
create table perfil
(
   id_perfil            int(11) not null auto_increment comment '{"label":"Id Perfil"}',
   nm_perfil            varchar(100) not null comment '{''label'':"Perfil"}',
   primary key (id_perfil)
)
ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: perfil_controller_action                              */
/*==============================================================*/
create table perfil_controller_action
(
   id_perfil_controller_action int(11) not null auto_increment,
   id_controller        int(11) not null,
   id_action            int(11) not null,
   id_perfil            int(11) not null,
   primary key (id_perfil_controller_action),
   key ix_perfil_controller_action_controller (id_controller),
   key ix_perfil_controller_action_action (id_action),
   key ix_perfil_controller_action_perfil (id_perfil)
)
ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: planejamento                                          */
/*==============================================================*/
create table planejamento
(
   id_planejamento      bigint not null,
   nm_problema          varchar(150),
   nm_recurso           varchar(150),
   tx_analise_swot      text,
   nm_avaliacao         varchar(150),
   nm_acao              varchar(150),
   nm_estrategia        varchar(150),
   nm_abordagem         varchar(150),
   nm_slogan            varchar(150),
   nm_tom_campanha      varchar(150),
   tx_peca              text,
   ar_arquivo           varchar(200),
   id_solicitacao       bigint,
   id_cronograma        bigint,
   primary key (id_planejamento)
);

/*==============================================================*/
/* Table: sexo                                                  */
/*==============================================================*/
create table sexo
(
   id_sexo              int(11) not null auto_increment,
   nm_sexo              varchar(45) not null comment '{"label":"Sexo"}',
   primary key (id_sexo)
)
ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: situacao                                              */
/*==============================================================*/
create table situacao
(
   id_situacao          int(11) not null auto_increment,
   nm_situacao          varchar(100) default NULL comment '{"label":"Situa��o"}',
   primary key (id_situacao)
)
ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: situacao_usuario                                      */
/*==============================================================*/
create table situacao_usuario
(
   id_situacao_usuario  int(11) not null auto_increment,
   nm_situacao_usuario  varchar(100) default NULL comment '{"label":"Situação usuário"}',
   primary key (id_situacao_usuario)
)
ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: solicitacao                                           */
/*==============================================================*/
create table solicitacao
(
   id_solicitacao       bigint not null,
   nm_solicitante       varchar(150),
   id_telefone_fixo     int(11),
   id_telefone_celular  int(11),
   id_email             int(11),
   id_departamento      int(11),
   id_usuario_cadastro  int(11),
   id_status            int(11),
   id_unidade          int(11),
   dt_data_criacao      datetime,
   dt_data_final_atendimento datetime,
   tx_informacao        text,
   nr_controle          int(11),
   primary key (id_solicitacao)
);

/*==============================================================*/
/* Table: solicitacao_tipo_servico                              */
/*==============================================================*/
create table solicitacao_tipo_servico
(
   id_solicitacao_tipo_servico int(11) not null,
   id_solicitacao       int(11),
   id_tipo_servico      int(11),
   primary key (id_solicitacao_tipo_servico)
);

/*==============================================================*/
/* Table: status                                                */
/*==============================================================*/
create table status
(
   id_status            int(11) not null,
   nm_status            varchar(150),
   primary key (id_status)
);

/*==============================================================*/
/* Table: telefone                                              */
/*==============================================================*/
create table telefone
(
   id_telefone          int(11) not null auto_increment,
   nr_ddd_telefone      varchar(3) default NULL comment '{"label":"ddd"}',
   nr_telefone          varchar(20) default NULL comment '{"label":"Telefone"}',
   id_tipo_telefone     int(11) not null,
   id_situacao          int(11) not null,
   primary key (id_telefone),
   key ix_telefones_tipo_telefone (id_tipo_telefone),
   key ix_telefones_situacao (id_situacao)
)
ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: tipo_servico                                          */
/*==============================================================*/
create table tipo_servico
(
   id_tipo_servico      int(11) not null,
   nm_tipo_servico      varchar(150),
   primary key (id_tipo_servico)
);

/*==============================================================*/
/* Table: tipo_telefone                                         */
/*==============================================================*/
create table tipo_telefone
(
   id_tipo_telefone     int(11) not null auto_increment,
   nm_tipo_telefone     varchar(100) default NULL comment '{"label":"Tipo telefone"}',
   primary key (id_tipo_telefone)
)
ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: tipo_usuario                                          */
/*==============================================================*/
create table tipo_usuario
(
   id_tipo_usuario      int(11) not null auto_increment,
   nm_tipo_usuario      varchar(100) default NULL comment '{"label":"Tipo usuário"}',
   primary key (id_tipo_usuario)
)
ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*==============================================================*/
/* Table: unidade                                               */
/*==============================================================*/
create table unidade
(
   id_unidade           int(11) not null,
   nm_unidade           varchar(50),
   primary key (id_unidade)
);

/*==============================================================*/
/* Table: usuario                                               */
/*==============================================================*/
create table usuario
(
   id_usuario           int(11) not null auto_increment,
   nm_usuario           varchar(250) not null comment '{"label":"Usu�rio"}',
   dt_nascimento        datetime not null comment '{"label":"Data de nascimento"}',
   id_sexo              int(11) default NULL,
   id_tipo_usuario      int(11) not null,
   id_situacao_usuario  int(11) not null,
   id_email             int(11) default NULL,
   id_telefone          int(11) default NULL,
   primary key (id_usuario),
   key ix_usuarios_sexo (id_sexo),
   key ix_usuarios_tipo_usuario (id_tipo_usuario),
   key ix_usuarios_situacao_usuario (id_situacao_usuario),
   key ix_usuarios_emails (id_email),
   key ix_usuarios_telefones (id_telefone)
)
ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

alter table atendimento add constraint FK_Reference_35 foreign key (id_solicitacao)
      references solicitacao (id_solicitacao) on delete restrict on update restrict;

alter table cidade add constraint FK_Reference_89 foreign key (id_estado)
      references estado (id_estado) on delete restrict on update restrict;

alter table cronograma add constraint FK_Reference_51 foreign key (id_equipe)
      references equipe (id_equipe) on delete restrict on update restrict;

alter table email add constraint fk_emails_situacao foreign key (id_situacao)
      references situacao (id_situacao);

alter table endereco add constraint fk_endereco_cidades1 foreign key (id_cidade)
      references cidade (id_cidade);

alter table equipe_funcao add constraint FK_Reference_52 foreign key (id_equipe)
      references equipe (id_equipe) on delete restrict on update restrict;

alter table equipe_funcao add constraint FK_Reference_53 foreign key (id_funcao)
      references funcao (id_funcao) on delete restrict on update restrict;

alter table esqueci_senha add constraint fk_esqueci_senha_situacoes1 foreign key (id_situacao)
      references situacao (id_situacao);

alter table esqueci_senha add constraint fk_esqueci_senha_usuarios1 foreign key (id_usuario)
      references usuario (id_usuario);

alter table fornecedor add constraint FK_Reference_34 foreign key (id_endereco)
      references endereco (id_endereco) on delete restrict on update restrict;

alter table fornecedor add constraint FK_Reference_37 foreign key (id_telefone_fixo)
      references telefone (id_telefone) on delete restrict on update restrict;

alter table fornecedor add constraint FK_Reference_38 foreign key (id_telefone_celular)
      references telefone (id_telefone) on delete restrict on update restrict;

alter table fornecedor add constraint FK_Reference_39 foreign key (id_email)
      references email (id_email) on delete restrict on update restrict;

alter table fornecedor_tipo_servico add constraint FK_Reference_40 foreign key (id_fornecedor)
      references fornecedor (id_fornecedor) on delete restrict on update restrict;

alter table fornecedor_tipo_servico add constraint FK_Reference_48 foreign key (id_tipo_servico)
      references tipo_servico (id_tipo_servico) on delete restrict on update restrict;

alter table login add constraint fk_Login_emails foreign key (id_email)
      references email (id_email);

alter table login add constraint fk_Login_perfil foreign key (id_perfil)
      references perfil (id_perfil);

alter table login add constraint fk_Login_situacao foreign key (id_situacao)
      references situacao (id_situacao);

alter table login add constraint fk_Login_usuarios foreign key (id_usuario)
      references usuario (id_usuario);

alter table perfil_controller_action add constraint fk_perfil_controller_action_action foreign key (id_action)
      references action (id_action);

alter table perfil_controller_action add constraint fk_perfil_controller_action_controller foreign key (id_controller)
      references controller (id_controller);

alter table perfil_controller_action add constraint fk_perfil_controller_action_perfil foreign key (id_perfil)
      references perfil (id_perfil);

alter table planejamento add constraint FK_Reference_36 foreign key (id_solicitacao)
      references solicitacao (id_solicitacao) on delete restrict on update restrict;

alter table planejamento add constraint FK_Reference_49 foreign key (id_cronograma)
      references cronograma (id_cronograma) on delete restrict on update restrict;

alter table solicitacao add constraint FK_Reference_41 foreign key (id_telefone_fixo)
      references telefone (id_telefone) on delete restrict on update restrict;

alter table solicitacao add constraint FK_Reference_42 foreign key (id_telefone_celular)
      references telefone (id_telefone) on delete restrict on update restrict;

alter table solicitacao add constraint FK_Reference_43 foreign key (id_email)
      references email (id_email) on delete restrict on update restrict;

alter table solicitacao add constraint FK_Reference_44 foreign key (id_departamento)
      references departamento (id_departamento) on delete restrict on update restrict;

alter table solicitacao add constraint FK_Reference_45 foreign key (id_usuario_cadastro)
      references usuario (id_usuario) on delete restrict on update restrict;

alter table solicitacao add constraint FK_Reference_50 foreign key (id_status)
      references status (id_status) on delete restrict on update restrict;

alter table solicitacao add constraint FK_Reference_54 foreign key (iid_unidade)
      references unidade (id_unidade) on delete restrict on update restrict;

alter table solicitacao_tipo_servico add constraint FK_Reference_46 foreign key (id_solicitacao)
      references solicitacao (id_solicitacao) on delete restrict on update restrict;

alter table solicitacao_tipo_servico add constraint FK_Reference_47 foreign key (id_tipo_servico)
      references tipo_servico (id_tipo_servico) on delete restrict on update restrict;

alter table telefone add constraint fk_telefones_situacao foreign key (id_situacao)
      references situacao (id_situacao);

alter table telefone add constraint fk_telefones_tipo_telefone1 foreign key (id_tipo_telefone)
      references tipo_telefone (id_tipo_telefone);

alter table usuario add constraint fk_usuarios_emails foreign key (id_email)
      references email (id_email);

alter table usuario add constraint fk_usuarios_endereco foreign key ()
      references endereco (id_endereco);

alter table usuario add constraint fk_usuarios_sexo foreign key (id_sexo)
      references sexo (id_sexo);

alter table usuario add constraint fk_usuarios_situacao_usuario foreign key (id_situacao_usuario)
      references situacao_usuario (id_situacao_usuario);

alter table usuario add constraint fk_usuarios_telefones foreign key (id_telefone)
      references telefone (id_telefone);

alter table usuario add constraint fk_usuarios_tipo_usuario foreign key (id_tipo_usuario)
      references tipo_usuario (id_tipo_usuario);

