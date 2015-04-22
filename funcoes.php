<?php

//Conexão com o banco de dados
function conexao(){
try {
    $config = include "config_1.php";
    if(! isset($config['db'])){
        throw new \InvalidArgumentException("A configuração do banco de dados não existe!");
    }
    
    $host = (isset($config['db']['host'])) ? $config['db']['host']:null;
    $user = (isset($config['db']['user'])) ? $config['db']['user']:null;
    $pass = (isset($config['db']['pass'])) ? $config['db']['pass']:null;
    $name = (isset($config['db']['name'])) ? $config['db']['name']:null;
    
    return new \PDO("mysql:host={$host};dbname={$name};charset=utf8", $user, $pass);
    
    } catch (\PDOException $e) {
        echo $e->getMessage(). "\n";
        echo $e->getTraceAsString(). "\n";
    }
}

// Função cadastrar pagina
function cadastrar($tabela, $dadosCadastrar)
{
    $pdo = conexao();
    $campos = count($dadosCadastrar);
    
    try {
        $cadastrar = $pdo->prepare("insert into {$tabela} (uri, nome, conteudo) values (?, ?, ?)");
        for ($i = 0; $i < $campos; $i ++):
            $cadastrar->bindValue($i+1, $dadosCadastrar[$i]);
        endfor;
        $cadastrar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
}

// Função cadastrar usuário
function cadastrarAdmin($tabela, $dadosCadastrar)
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

// Função listar
function listar($tabela)
{
    $pdo = conexao();
    
    try {
        $listar = $pdo->prepare("select * from $tabela");
        $listar->execute();
        $dados = $listar->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $exc->getTraceAsString();
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
    return $dados ;

}

// Função atualizar
function atualizar($tabela, $dadosAtualizar, $id)
{
    $pdo = conexao();
    
    try {
        $atualizar = $pdo->prepare("update {$tabela} set conteudo = ? where id = ?");
        $atualizar->bindValue(1, $dadosAtualizar['conteudo']);
        $atualizar->bindValue(2, $id);
        $atualizar->execute();
    } catch (PDOException $e) {
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
}

// Função deletar
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

// Função listar páginas
function listarpagina($tabela, $pagina)
{
    $pdo = conexao();
    
    try {
        $listarPeloId = $pdo->prepare("select * from {$tabela} where pagina = :pagina");
        $listarPeloId->bindValue(":pagina", $pagina);
        $listarPeloId->execute();
        $dados = $listarPeloId->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $exc->getTraceAsString();
        die("Error: Código: {$e->getCode()} | Mensagem: {$e->getMessage()} |  Arquivo: {$e->getFile()} | linha: {$e->getLine()}");
    }
    return $dados ;
}