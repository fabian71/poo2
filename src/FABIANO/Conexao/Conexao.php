<?php

namespace FABIANO\Conexao;

use \PDO;

class Conexao extends PDO
{
	public $dbname = 'bd_poo';
	private $host = "mysql:host=localhost;dbname=bd_poo";
	private $user = 'root';
	private $password = 'root';
	public $tabela = 'clientes';
	public $handle = null;
	
	function __construct( ) 
	{
		try 
		{
			if ($this->handle == null) 
			{
				$dbh = parent::__construct( $this->host , $this->user , $this->password);
				$this->handle = $dbh;
				return $this->handle;
			}
		}

		catch (PDOException $e) 
		{
			echo 'Erro na conexão: ' . $e->getMessage();
			return false;
		}
	}

	function __destruct() 
	{
		$this->handle = NULL;
	}

	
}