<?php

namespace FABIANO\Cliente\Tipos; 

class TypePessoaJuridica extends \FABIANO\Cliente\Util\ClienteAbstrato 
{	

	private $nomeFantasia;
    private $razaoSocial;
    private $cnpj;

    public function getNomeFantasia()
    {
        return $this->nomeFantasia;
    }
    
    public function setNomeFantasia($nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
        return $this;
    }

    public function getRazaoSocial()
    {
        return $this->razaoSocial;
    }
    
    public function setRazaoSocial($razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }
    
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }
    
}