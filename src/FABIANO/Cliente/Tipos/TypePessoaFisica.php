<?php

namespace FABIANO\Cliente\Tipos; 

class TypePessoaFisica extends \FABIANO\Cliente\Util\ClienteAbstrato 
{	

	private $nome;
    private $cpf;
    private $rg;

    public function getNome()
    {
        return $this->nome;
    }
    
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    public function getCpf()
    {
        return $this->cpf;
    }
    
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }
    public function getRg()
    {
        return $this->rg;
    }
    
    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }

}