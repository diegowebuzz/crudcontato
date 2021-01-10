drop database contatos;
create database contatos;
use  contatos;

CREATE TABLE contato (
  id int NOT NULL AUTO_INCREMENT,
  nome char(100) DEFAULT NULL,
  PRIMARY KEY (id),
  created_at datetime,
  updated_at datetime
);

CREATE TABLE celular (
  id integer auto_increment key,
  id_contato int,
  numero char(14)
);


CREATE TABLE email (
  id integer auto_increment key,
  id_contato int DEFAULT NULL,
  endereco varchar(100) DEFAULT NULL
);

CREATE TABLE endereco (
  id int NOT NULL AUTO_INCREMENT,
  id_contato int DEFAULT NULL,
  logradouro varchar(200) DEFAULT NULL,
  bairro varchar(200) DEFAULT NULL,
  uf varchar(3) DEFAULT NULL,
  localidade varchar(200) DEFAULT NULL,
  PRIMARY KEY (id)
);
CREATE TABLE telefone (
  id integer auto_increment key,
  id_contato int DEFAULT NULL,
  numero char(13) DEFAULT NULL
   
)



