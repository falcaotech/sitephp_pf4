<?php

require_once 'funcoes.php';

function criaBanco() {
    $host    = 'mysql:host=localhost';
    $user    = 'root';
    $pass    = 'root';
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
    $name    = 'sitephp';
    $table   = 'pagina';

    try {
        $pdo = new PDO($host, $user, $pass, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->query("CREATE DATABASE IF NOT EXISTS $name");
        $pdo->query("use $name");
        print("O banco de dados {$name} foi criado com sucesso!<br>");
        $tabl ="CREATE table $table(
        id INT( 10 ) AUTO_INCREMENT NOT NULL PRIMARY KEY,
        uri VARCHAR( 250 ) NOT NULL, 
        nome VARCHAR( 250 ) NOT NULL,
        conteudo VARCHAR( 250 ) NOT NULL);";
        $pdo->exec($tabl);
        print("A tabela {$table} foi criada com sucesso!<br>");
        
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
    return $pdo;
}

criaBanco();
$cadastrarDados = array('home','Home', 'Descrição do conteúdo da página home');
cadastrar('pagina',$cadastrarDados);
$cadastrarDados = array('empresa','Empresa', 'Descrição do conteúdo da página empresa');
cadastrar('pagina',$cadastrarDados);
$cadastrarDados = array('produtos','Produtos', 'Descrição do conteúdo da página produtos');
cadastrar('pagina',$cadastrarDados);
$cadastrarDados = array('servicos','Serviços', 'Descrição do conteúdo da página serviços');
cadastrar('pagina',$cadastrarDados);
$cadastrarDados = array('contato','Contato', 'Descrição do conteúdo da página contato');
cadastrar('pagina',$cadastrarDados);


function criarAdmin() {
    $host    = 'mysql:host=localhost';
    $user    = 'root';
    $pass    = 'root';
    $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
    $name    = 'sitephp';
    $table   = 'admin';

    try {
        $pdo = new PDO($host, $user, $pass, $options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->query("CREATE DATABASE IF NOT EXISTS $name");
        $pdo->query("use $name");
        $tabl ="CREATE table $table(
        id INT( 10 ) AUTO_INCREMENT NOT NULL PRIMARY KEY,
        login VARCHAR( 250 ) NOT NULL,
        senha VARCHAR( 250 ) NOT NULL);";
        $pdo->exec($tabl);
        print("A tabela {$table} foi criada com sucesso!<br>");
        
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
    return $pdo;
}
//função para pegar a senha digitada e cadastrar no banco de dados cryptografada
function passCrypt($senha)
{
    $senhaCrypt = password_hash($senha, PASSWORD_DEFAULT);
    return $senhaCrypt;
}

criarAdmin();
$cadastrarDados = array('admin', passCrypt('1234'));
cadastrarAdmin('admin',$cadastrarDados);