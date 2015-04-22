<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('America/Sao_Paulo');
session_start();
require_once 'functions/functionsDb.php';
require_once 'functions/route.php';

if(!($_SESSION['loginUser'])){
    header('Location: ../index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/estilo.css" type="text/css" rel="stylesheet" />
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <div id="conteudo">
            <div class="row">
                <div class="page-header col-md-12">
                    <div class="col-md-7 col-md-offset-2">
                        <h1>Área administrativa</h1>
                    </div>
                    <div class="col-md-1 margin-top">
                        <a href="logoff.php"><button class="btn btn-danger" type="submit" name="sair" >SAIR</button></a>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2">
                    <?php require_once(route());?> 
                </div>
            </div>
        </div>
        <footer class="footer">
            <hr />
            <p id="creditos">
                © Todos os direitos reservados - 
                <?php
                    date_default_timezone_set('America/Sao_paulo');
                    echo date("Y");
                ?>
            </p>
        </footer>
    </div>
    <script src="ckeditor/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'editor1' );
    </script>
</body>
</html>