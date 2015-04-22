<?php
    require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site PHP</title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
     <!-- Css -->
    <link href="/css/estilo.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
    <body>
        <div class="container">
            <!--MENU PRINCIPAL-->
            <!--<li><a href="/home">Home</a></li>
            <li><a href="/empresa">Empresa</a></li>
            <li><a href="/produtos">Produtos</a></li>
            <li><a href="/servicos">Sertviços</a></li>
            <li><a href="/contato">Contato</a></li>-->
            
                
            <?php
                $conn = conexao();
                $q = (isset($_GET['q']) && !empty($_GET['q'])) ? $_GET['q'] : '';
                $sql = "SELECT * FROM pagina WHERE (nome LIKE :q);";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue("q", '%'.$q.'%');
                $stmt->execute();
                $paginas = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            ?>

            
            <ul id="menu">
                <?php
                    if (count($paginas)) {
                        foreach ($paginas as $pagina) {

                        echo '<li><a href="' . $pagina['uri'] . '">' . $pagina['nome'] . '</a></li>';
                        }
                    }
                ?>
                
            </ul>
            
            <!--FORMULÁRIO DE BUSCA POR PALAVRA CHAVE-->
            <form class="form-inline" name="busca" method="get" action="/busca">
                <div class="form-group">
                    <input type="text" name="q" class="form-control" id="" placeholder="">
                </div>
                <input type="submit" name="submit" value="Buscar" class="btn btn-default">
            </form>
            
            <hr />