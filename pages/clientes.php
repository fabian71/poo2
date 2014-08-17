<?php

/* Conexao com o banco de dados */
$conexao = new FABIANO\Conexao\Conexao();

/* Selecionando os clientes */
$sql = "select * from {$conexao->tabela}";
$stmt = $conexao->prepare($sql);
$stmt->execute();

/* Passando os clientes para o array */
$clienteArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($clienteArray as $cadaCliente) {

    $cadaCliente['endereco'] = unserialize ($cadaCliente['endereco']);

    if($cadaCliente['tipo'] == 'pf'){

      $cliente = new FABIANO\Cliente\Tipos\TypePessoaFisica();
      $cliente->setStars($cadaCliente['stars'])
              ->setId($cadaCliente['ID'])
              ->setTelefone($cadaCliente['telefone'])
              ->setEmail($cadaCliente['email'])
              ->setIsJuridica(false)
              ->setNome($cadaCliente['nome'])
              ->setCpf($cadaCliente['cpf'])
              ->setRg($cadaCliente['rg']);

      foreach ($cadaCliente['endereco'] as $cadaEndereco) {
        $cliente->setEndereco($cadaEndereco);
      }

    }elseif($cadaCliente['tipo'] == 'pj'){

      $cliente = new FABIANO\Cliente\Tipos\TypePessoaJuridica();
      $cliente->setStars($cadaCliente['stars'])
              ->setId($cadaCliente['ID'])
              ->setTelefone($cadaCliente['telefone'])
              ->setEmail($cadaCliente['email'])
              ->setIsJuridica(true)
              ->setNomeFantasia($cadaCliente['nomeFantasia'])
              ->setRazaoSocial($cadaCliente['razaoSocial'])
              ->setCnpj($cadaCliente['cnpj']);
      
      foreach ($cadaCliente['endereco'] as $cadaEndereco) {
        $cliente->setEndereco($cadaEndereco);
      }      

    }

    $arrayCliente[] = $cliente;
}



$uri = explode('/',$_SERVER ['REQUEST_URI']);

array_shift($uri);

// Imprime na tela
$conteudo = new FABIANO\Cliente\Util\MostraCliente();

if((count($uri) > 1) AND ($uri[1] != '')){
  
  // Mostra conteudo
  $mostraConteudo = $conteudo->geraConteudo($arrayCliente[$uri[1]]);
}else{
  
  // Mostra Lista
  if(strstr($uri[0], '?ordem=')){
    $pegaOrdem = explode("?ordem=", $uri[0]);
    $ordem = $pegaOrdem[1];
  }else{
    $ordem = 'asc';
  }

  $mostraConteudo = $conteudo->geraLista($arrayCliente,$ordem);
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Lista Clientes</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/starter-template.css" rel="stylesheet">
    
    <!-- icones -->
    <link href="/css/font-awesome.css" rel="stylesheet">
    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">PHP OO</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/clientes">Lista Cliente</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

    <!-- conteudo -->
    <?php
      echo $mostraConteudo;
    ?>    

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
  </body>
</html>
