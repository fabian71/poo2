<?php

namespace FABIANO\Cliente\Util;

class Endereco extends \FABIANO\Cliente\Cliente
{
	private $endereco;
	private $cidade;
	private $estado;
	private $enderecoCobranca = false;

	public function __construct($enderecoCobranca,$endereco,$cidade,$estado)
	{
		$this->setEnderecoCobranca($enderecoCobranca)
			 ->setEndereco($endereco)
			 ->setCidade($cidade)
			 ->setEstado($estado)
			 ;
	}

	public function getEndereco()
	{
	    return $this->endereco;
	}
	
	public function setEndereco($endereco)
	{
	    $this->endereco = $endereco;
	    return $this;
	}

	public function getCidade()
	{
	    return $this->cidade;
	}
	
	public function setCidade($cidade)
	{
	    $this->cidade = $cidade;
	    return $this;
	}
	public function getEstado()
	{
	    return $this->estado;
	}
	
	public function setEstado($estado)
	{
	    $this->estado = $estado;
	    return $this;
	}
	public function getCep()
	{
	    return $this->cep;
	}
	
	public function setCep($cep)
	{
	    $this->cep = $cep;
	    return $this;
	}
	public function getEnderecoCobranca()
	{
	    return $this->enderecoCobranca;
	}
	
	public function setEnderecoCobranca($enderecoCobranca)
	{
	    $this->enderecoCobranca = $enderecoCobranca;
	    return $this;
	}

}