<?php

function conexao(){    
try {
    $config = include "config_1.php";
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