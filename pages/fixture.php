<?php

// Configurando o autoload
if (!(defined('CLASS_DIR'))){
    define('CLASS_DIR','../src/');
}
set_include_path(get_include_path().PATH_SEPARATOR.CLASS_DIR);
spl_autoload_register();

/* Arary de clientes para ser persistir no banco de dados */
$clienteArray[] = [
            'email'=>'email@email.com',
            'telefone'=>'4492828222',
            'tipo'=>'pf',
            'nome'=>'Fabianooo',
            'cpf'=>'7632832632',
            'rg'=>'32987328237',
            'nomeFantasia'=>'',
            'razaoSocial'=>'',
            'cnpj'=>'',
            'stars'=> 4,
            'endereco' => ['#cb# Avenida Brasil, 454, terreo, Maringá PR',
                           'Avenida Paulista, 22, , São Paulo SP']
            ];

			$clienteArray[] = [
            'email'=>'email2@email.com',
            'telefone'=>'6692828222',
            'tipo'=>'pj',
            'nome'=>null,
            'cpf'=>null,
            'rg'=>null,
            'nomeFantasia'=>'Comercio Teste',
            'razaoSocial'=>'Comercio Ltda',
            'cnpj'=>'3763282683232',
            'stars'=> 3,
            'endereco' => ['#cb# rua teste, 221, terreo, Curitiba PR']
            ];   

			$clienteArray[] = [
            'email'=>'email3@email.com',
            'telefone'=>'9923828222',
            'tipo'=>'pf',
            'nome'=>'Luiz Padilha',
            'cpf'=>'9692832638',
            'rg'=>'31987329231',
            'nomeFantasia'=>null,
            'razaoSocial'=>null,
            'cnpj'=>null,
            'stars'=> 2,
            'endereco' => ['Avenida São Paulo, 22, Curitiba PR',
                           '#cb# Avenida Brigadeiro faria lima,0001, , São Paulo SP']
            ];     

			$clienteArray[] = [
            'email'=>'email4@email.com',
            'telefone'=>'0092828233',
            'tipo'=>'pj',
            'nome'=>null,
            'cpf'=>null,
            'rg'=>null,
            'nomeFantasia'=>'Comercio Teste 2',
            'razaoSocial'=>'Comercio 2 Ltda',
            'cnpj'=>'9963252683237',
            'stars'=> 3,
            'endereco' => ['#cb# rua xpto, 000, ap 44, Curitiba PR']
            ]; 

			$clienteArray[] = [
            'email'=>'email5@email.com',
            'telefone'=>'0782828923',
            'tipo'=>'pj',
            'nome'=>null,
            'cpf'=>null,
            'rg'=>null,
            'nomeFantasia'=>'Xttp 332',
            'razaoSocial'=>'Comercio Xpto 9 Ltda',
            'cnpj'=>'6363252683242',
            'stars'=> 3,
            'endereco' => ['#cb# rua xpto, 83343, Rio de janeiro RJ']
            ]; 

			$clienteArray[] = [
            'email'=>'email6@email.com',
            'telefone'=>'11782828923',
            'tipo'=>'pj',
            'nome'=>null,
            'cpf'=>null,
            'rg'=>null,
            'nomeFantasia'=>'Xttoo 213',
            'razaoSocial'=>'Comercio Xpto 11 Ltda',
            'cnpj'=>'3363252222683242',
            'stars'=> 3,
            'endereco' => ['#cb# rua teste, 12, Campinas SP']
            ];

try
{
	/* Retorna o objeto PDO Inteiro */
	$con = new FABIANO\Conexao\Conexao();

	/* Faz a persistencisa com o banco de dados */
	$fixture = new FABIANO\Fixture\PercistenciaBanco($con,$con->tabela);
	$fixture->flush($clienteArray);
}

catch(\PDOException $e)
{
	die("Erro: ". $e->getCode().": ".$e->getMessage());
}
