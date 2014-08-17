<?php

namespace FABIANO\Fixture;

use \PDO;

class PercistenciaBanco
{	
	private $con;
	private $tabela;
	private $dbname;
	private $clienteArray;



	public function __construct(PDO $con,$tabela)
	{
		$this->con = $con;
		$this->con->dbname;
		$this->con->query("use {$this->con->dbname}");
		$this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );
		$this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		$this->con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		$this->tabela = $tabela;

		/* Verifica se a tabela existe */
		$this->existeTabela();
	}


	public function getCon()
	{
	    return $this->con;
	}

	/* Verifica se a tabela existe */
	private function existeTabela()
	{
		$tableExists = $this->con->query("SHOW TABLES LIKE '{$this->tabela}'")->rowCount() > 0;

		if($tableExists)
		{
			/* chama o metdo Deleta a tabela */
			$this->deletaTabela();

		}else
		{	
			/* chama o metodo para criar a tabela */
			$this->criaTabela();
		}
	}

	/* Deleta a tabela */
	private function deletaTabela()
	{
		$sql = "DELETE FROM {$this->tabela}";
		$stmt = $this->con->prepare($sql); 
		$stmt->execute();
		echo 'Tablela '.$this->tabela.' deletada...'."<br>\r\n";
	}

	/* Cria a tabela */
	private function criaTabela()
	{
		$q="CREATE TABLE {$this->tabela} (
		  ID int(11) NOT NULL AUTO_INCREMENT,
		  status enum('d','i') NOT NULL DEFAULT 'd', 
		  email varchar(100) NOT NULL,
		  telefone varchar(100) NOT NULL,
		  tipo enum('pf','pj') NOT NULL DEFAULT 'pf', 
		  nome varchar(100) NOT NULL,
		  cpf varchar(100) NOT NULL,
		  rg varchar(100) NOT NULL,
		  nomeFantasia varchar(100) NOT NULL,
		  razaoSocial varchar(100) NOT NULL,
		  cnpj varchar(100) NOT NULL,
		  stars varchar(20) NOT NULL,
		  endereco text NOT NULL,
		  data_cad TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		  PRIMARY KEY (ID),
		  UNIQUE KEY ID (ID)
		  ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
	";


		try {
			$this->con->exec($q);
		 	echo 'Tablela '.$this->tabela.' criada...'."<br>\r\n";
		}
			catch (PDOException $e) {
		 	echo $e->getMessage();
		}
	}


	/* inserindo na tabela */
	public function flush($clienteArray)
	{
		$sql = "INSERT INTO {$this->tabela}(email,telefone,tipo,nome,cpf,rg,nomeFantasia,razaoSocial,cnpj,stars,endereco) VALUES (:email,:telefone,:tipo,:nome,:cpf,:rg,:nomeFantasia,:razaoSocial,:cnpj,:stars,:endereco)";

		$stmt = $this->con->prepare($sql);	

		foreach ($clienteArray as $k => $v) 
		{	
    		foreach ($v as $k1 => $v1) 
    		{
    			if($k1 == 'endereco'){
    				$v1 = serialize($v1);
    			}

    			if($v1 == ''){
    				$v1 = '';
    			}

    			echo "Inserindo: $k1 => $v1"."<br>\r\n";

    			if($stmt->bindValue(":$k1", $v1)){
    				echo "OK"."<br>\r\n";
    			}else{
    				echo "Erro"."<br>\r\n";
    			}
		    }
		    $stmt->execute();
		}
		echo 'Dados adicionados a tabela '.$this->tabela."<br>\r\n";
	}	
}