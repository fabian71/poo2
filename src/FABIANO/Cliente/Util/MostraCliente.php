<?php

namespace FABIANO\Cliente\Util;

class MostraCliente
{
	private $lista;
	private $dados;
	private $retorno;
	private $ordem;

	public function geraLista($lista,$ordem)
	{
    	$this->retorno = '
    	<h3>Listando clientes</h3>

	      <ul class="nav nav-tabs" role="tablist">
	      <li class="dropdown">
	        <a class="dropdown-toggle" data-toggle="dropdown" href="?ordem=asc">
	          Ordenar <span class="caret"></span>
	        </a>
	        <ul class="dropdown-menu" role="menu">
	          <li><a href="?ordem=asc">ascendente</a></li>
	          <li><a href="?ordem=desc">decrecente</a></li>
	        </ul>
	      </li>
	    </ul>
	    ';

	    if($ordem == 'asc'){
			ksort ($lista);
		}else{
		  	krsort ($lista);
		}


	   $this->retorno .=  "
	  <div class=\"panel panel-default\">
      <!-- Default panel contents -->
      <div class=\"panel-heading\">Clientes</div>

      <!-- Table -->
      <table class=\"table\">
        <thead>
          <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Tipo</th>
            <th>Reputação</th>
          </tr>
        </thead>
        <tbody>
	   ";
    	foreach ($lista as $key => $cliente) {


    		if($cliente->getIsJuridica()){
    			$tipo = 'P. Jurídica';
    			$nome = $cliente->getNomeFantasia();
    		}else{
    			$tipo = 'P. Física';	
    			$nome = $cliente->getNome();
    		}

    		$stars = '';
    		for ($i = 1; $i <= $cliente->getStars(); $i++) {
    			$stars .= '<span>&#9734;</span>';
			}

    		$this->retorno .= '<tr>
					            <td>'.$cliente->getId().'</td>
					            <td><a href="/clientes/'.$key.'">'.$nome.'</a></td>
					            <td>'.$tipo.'</td>
					            <td>
								<div class=\"rating\">
								'.$stars.'
								</div>
					            </td>
					          </tr>';

			unset($stars);
		}
		$this->retorno .= '
        	</tbody>
      		</table>
    	</div>
		';

		return $this->retorno;
	}

	public function geraConteudo($dados)
	{	

		$stars = '';
    	for ($i = 1; $i <= $dados->getStars(); $i++) {
    		$stars .= '<span>&#9734;</span>';
		}

		// Pegando os enderecos
		$enderecos = $dados->getEndereco();

		$mostraEndeco = '<ul class="list-group">';

		// Removendo array vazio
		$enderecos = array_filter($enderecos);

        foreach ($enderecos as $endereco) 
        {

        	if(strstr($endereco, '#cb#')){
				$ender = explode("#cb#", $endereco);
				$endereco_final  = $ender[1];
				$cobranca = '<span class="label label-default">Cobrança</span>';
			}else{
				$endereco_final = $endereco;
				$cobranca = '';
			}


        	$mostraEndeco .= '
        				<li class="list-group-item">
					  		'.$cobranca.'
							<div class="form-group">
					            <label class="col-sm-2 control-label">Endereço</label>
					            <div class="col-sm-10">
					              <p class="form-control-static">'.$endereco_final.'</p>
					            </div>
				          	</div>
			          	
					  	</li>';
        }
        $mostraEndeco .= '</ul>';

		$completaForm = '';
		if($dados->getIsJuridica()){

    		$completaForm .= '
    				  <div class="form-group">
			            <label class="col-sm-2 control-label">Nome Fantasia</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$dados->getNomeFantasia().'</p>
			            </div>
			          </div>
					  <div class="form-group">
			            <label class="col-sm-2 control-label">Razão Social</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$dados->getRazaoSocial().'</p>
			            </div>
			          </div>
					  <div class="form-group">
			            <label class="col-sm-2 control-label">CNPJ</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$dados->getCnpj().'</p>
			            </div>
			          </div>			          
			          ';

    	}else{

    		$completaForm .= '
    				<div class="form-group">
			            <label class="col-sm-2 control-label">Nome</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$dados->getNome().'</p>
			            </div>
			          </div>
			          <div class="form-group">
			            <label class="col-sm-2 control-label">Cpf</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$dados->getCpf().'</p>
			            </div>
			          </div>
			          ';
    	}
		
		$this->retorno = '
		    <h3></span> Informações do clientes</h3>

		    <div class="panel panel-default">
		      <div class="panel-body">
		        
		            <!-- mostra -->

		            <form class="form-horizontal" role="form">
			          <div class="form-group">
			            <label class="col-sm-2 control-label">Reputação</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$stars.'</p>
			            </div>
			          </div>

					  '.$completaForm.'

			          <div class="form-group">
			            <label class="col-sm-2 control-label">Email</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$dados->getEmail().'</p>
			            </div>
			          </div>
			          <div class="form-group">
			            <label class="col-sm-2 control-label">Telefone</label>
			            <div class="col-sm-10">
			              <p class="form-control-static">'.$dados->getTelefone().'</p>
			            </div>
			          </div>

			          '.$mostraEndeco.'

            
			        </form>

		      </div>
		    </div>  
		    <!-- Standard button -->
		    <button type="button" onClick="javascript:history.go(-1)" class="btn btn-default">Voltar</button>
		';

		return $this->retorno;
	}
}