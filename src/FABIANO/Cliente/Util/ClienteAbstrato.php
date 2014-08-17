<?php

namespace FABIANO\Cliente\Util;

abstract class ClienteAbstrato
{
    
	private $ID;
	private $email;
	private $telefone;
	private $isJuridica;
	private $stars;
	private $endereco = array();

	public function getEndereco()	
	{	
		$endereco[] = '';
		foreach ($this->endereco as $cadaEndereco) {
			
			$endereco[] = $cadaEndereco;

		}

	  	$this->endereco = $endereco;
	  	return $this->endereco;
	}


	public function setEndereco($endereco)
	{
	    $this->endereco[] = $endereco;
	    return $this;
	}


	public function getId()
	{
	    return $this->id;
	}

	public function setId($ID)
	{
	    $this->id = $ID;
	    return $this;
	}
	public function getEmail()
	{
	    return $this->email;
	}

	public function setEmail($email)
	{
	    $this->email = $email;
	    return $this;
	}
	public function getTelefone()
	{
	    return $this->telefone;
	}

	public function setTelefone($telefone)
	{
	    $this->telefone = $telefone;
	    return $this;
	}
	public function getIsJuridica()
	{
	    return $this->isJuridica;
	}

	public function setIsJuridica($isJuridica)
	{
	    $this->isJuridica = $isJuridica;
	    return $this;
	}
	public function getStars()
	{
	    return $this->stars;
	}

	public function setStars($stars)
	{
	    $this->stars = $stars;
	    return $this;
	}

}