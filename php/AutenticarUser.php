<?php

    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }   

    $_SESSION['nome_login'] = $_POST["login"];
    $pass= $_POST["pwd"];
    $User = $_SESSION['nome_login'];

    //Localização do xml que contém o login e senha do usuário que está requisitando acesso
    //===========================================
    $path = "../contas/".$User."/login.xml";
    //===========================================

    //Leitura do XML
    $xml_string = file_get_contents($path);
    $xml_objeto = simplexml_load_string($xml_string);

    //Colocando os dados do XML dentro de um vetor
    $retorno["user"] = trim($xml_objeto->usuario);
    $retorno["pwd"] = trim($xml_objeto->senha);
    $_SESSION['nome'] = trim($xml_objeto->nome);
    $_SESSION['sobrenome'] = trim($xml_objeto->sobrenome);
    
    echo json_encode($retorno);
?>