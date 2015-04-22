<?php
function conexao(){    
try {
    $config = include "config.php";
    if(! isset($config['db'])){
        throw new \InvalidArgumentException("A configuração do banco de dados não existe!");
    }
    
    $host       = (isset($config['db']['host']))        ? $config['db']['host']:null;
    $user       = (isset($config['db']['user']))        ? $config['db']['user']:null;
    $pass       = (isset($config['db']['pass']))        ? $config['db']['pass']:null;
    $name       = (isset($config['db']['name']))        ? $config['db']['name']:null;
    
    return new \PDO("mysql:host={$host};dbname={$name};charset=utf8", $user, $pass);
    
    } catch (\PDOException $e) {
        echo $e->getMessage(). "\n";
        echo $e->getTraceAsString(). "\n";
    }
}
// Função listar DB
function listar($tabela)
{
    $pdo = conexao();
    
    try {
        $listar = $pdo->prepare("select * from $tabela");
        $listar->execute();
        $dados = $listar->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
    return $dados ;

}

// Função deletar DB
function deletar($tabela, $id)
{
    $pdo = conexao();
    
    try {
        $deletar = $pdo->prepare("delete from {$tabela} where id = :id");
        $deletar->bindValue(":id", $id);
        $deletar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
}


// Função listar pelo id DB
function listarId($tabela, $id)
{
    $pdo = conexao();
    
    try {
        $listarPeloId = $pdo->prepare("select * from {$tabela} where id = :id");
        $listarPeloId->bindValue(":id", $id);
        $listarPeloId->execute();
        $dados = $listarPeloId->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $exc->getTraceAsString();
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
    return $dados ;
}

function atualizar()
{
    if(isset($_POST['alterar'])){
        $id = addslashes(trim($_POST['id']));
        $uri = addslashes(trim($_POST['uri']));
        $nome = addslashes(trim($_POST['nome']));
        $conteudo = addslashes(trim($_POST['editor1']));
        
        try {
            $pdo = conexao();

            $atualizar = $pdo->prepare("UPDATE pagina SET uri = :uri, nome = :nome, "
                . "conteudo = :conteudo where id = :id");
            $atualizar->bindValue(":uri", $uri);
            $atualizar->bindValue(":nome", $nome);
            $atualizar->bindValue(":conteudo", $conteudo);
            $atualizar->bindValue(":id", $id);
            $atualizar->execute();
        } catch (PDOException $e) {
            die("Error: Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()} <br>  Arquivo: {$e->getFile()} <br> linha: {$e->getLine()}");
        }

    }else{
        echo "ERROR: Erro ao alterar!";
    }
}

// Função cadastrar DB
function cadastrar($tabela, $dadosCadastrar)
{
    $pdo = conexao();
    $campos = count($dadosCadastrar);
    
    try {
        $cadastrar = $pdo->prepare("insert into {$tabela} (login, senha) values (?, ?)");
        for ($i = 0; $i < $campos; $i ++):
            $cadastrar->bindValue($i+1, $dadosCadastrar[$i]);
        endfor;
        $cadastrar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
}

// função para cryptografia de senha
function passCrypt($senha)
{
    $senhaCrypt = password_hash($senha, PASSWORD_DEFAULT);
    return $senhaCrypt;
}

// função para pegar senha
function password()
{
    $dados = listar('admin');
    foreach ($dados as $key => $value) {
        return $value['senha'];
    }
}

// Função logar no painel administrativo
function logarsistema($user)
{
    $pdo = conexao();


    try {
        $login = $pdo->prepare("select * from admin where login = :login");
        $login->bindValue(":login", $user);
        $login->execute();

            return ($login->rowCount() == 1) ? true : false;
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} <br> Mensagem: {$e->getMessage()} <br>  Arquivo: {$e->getFile()} <br> linha: {$e->getLine()}");
    }   

}