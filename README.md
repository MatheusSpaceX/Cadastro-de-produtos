# Cadastro-de-produtos
Crud simples de produtos 

para executar crie o banco em MySQL. Abaixo código sql
create database testematheus
default collate utf8_general_ci
default charset utf8;

use testematheus;

create table fornecedores(
	codigo int auto_increment primary key,
    nome varchar(30),
    email varchar(50)
) default charset utf8;

create table produto (
	codigo int auto_increment primary key,
    Produto varchar(30),
    Quantidade varchar(50)
) default charset utf8;

create table testematheus(
	codigo int auto_increment primary key,
    Produto varchar(30),
    Quantidade varchar(50)
) default charset utf8;

INSERT INTO Produto VALUES
(null, 'opa', '1'),
(null, 'maça', '7'),
(null, 'maça', '7'),
(null, 'me aprova', '6'),
(null, 'to a muito tempo', '4'),
(null, 'pronto', '9'),
(null, 'cabei', '10');
