<?php
    //configurações gerais
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $banco = "agenda";

    //conexão
    try {
        $pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $erro) {
        echo "Falha ao se conectar com o banco de dados".$erro->getMessage();
    }

    //função para limpeza de entradas 
    function limparPost($dado){
        $dado = trim($dado);
        $dado = stripslashes($dado);
        $dado = htmlspecialchars($dado);
        return $dado;
    }
?>