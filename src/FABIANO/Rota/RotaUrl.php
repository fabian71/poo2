<?php

namespace FABIANO\Rota;

class RotaUrl
{
	public $url;

	public function __construct($url)
	{
		$this->url = $url;	
		$this->redireciona($this->url);
	}

	public function redireciona($url){
		$rota = parse_url($url);
		$path = $rota['path'];
		$pathArray = explode('/',$path);
		
		// Remove o primeiro item vazio da array
		$removeArray = array_shift($pathArray);
		
		$paginas = ['clientes' => '../pages/clientes.php',
					'lista_clientes'  => '../pages/clientes.php',
					'fixture'  => '../pages/fixture.php'
				   ];
		
		//carrega o home
		if(!$pathArray[0]){

			require_once('../pages/clientes.php');
		
		}elseif(($pathArray[0])){
			
			if (array_key_exists($pathArray[0], $paginas)) {
				//print_r($paginas);
				array_walk($paginas, function ($item, $key) use($pathArray){
					if($pathArray[0] == $key){		
						require_once($item);
					}
				});		

			}else{
				header('HTTP/1.0 404 Not Found');
				require_once('pages/404.php');
			}

		}else{
				header('HTTP/1.0 404 Not Found');
				require_once('pages/404.php');
		}

	}

}