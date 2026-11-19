<?php
require_once __DIR__ . "/../controllers/UsuarioController.php";

$rota = $_GET["rota"] ?? "";
$metodo = $_SERVER["REQUEST_METHOD"];

if ($rota === "usuario"){
    switch($metodo){
        case "POST":
            createUsuario($con);
            break;
        case "GET":
            readUsuario($con);
            break;
        case "PUT":
            updateUsuario($con);
            break;
        case "DELETE":
            deleteUsuario($con);
            break;
        default:
            teste();
    }
}else if ($rota === "publicacoes"){
    switch($metodo){
        case "POST":
            createPublicacoes($con, $corpo);
            break;
        case "GET":
            readPublicacoes($con);
            break;
        case "PUT":
            updatePublicacoes($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            deletePublicacoes($con, $_GET["id"]);
            break;
        default:
            teste();        
    }
}else if ($rota === "curtidas"){
    switch($metodo){
        case "POST":
            createCurtidas($con, $corpo);
            break;
        case "GET":
            readCurtidas($con);
            break;
        case "PUT":
            updateCurtidas($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            deleteCurtidas($con, $_GET["id"]);
            break;
        default:
            teste();        
    }
}