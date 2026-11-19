<?php
require_once __DIR__ . "/../models/UsuarioModel.php";

function teste(){
    echo json_encode([
        "mensagem" => "Back-End respondendo com sucesso!"
    ]);
    exit;
}
// Receber e validar os dados
function receberDadosUsuario(){
    $dados = json_decode(
        file_get_contents("php://input"), true);
    if(!is_array($dados)){
        http_response_code(400);
        echo_json_encode([
            "erro"=>"Envie um objeto JSON com dados!"
        ]);
        return null;
    }
    //nome, username, email e senha -> se existe
    foreach(["nome","username","email","senha"] as $campo){
        if( !isset($dados[$campo]) ||
            !is_string($dados[$campo]) ||
            trim($dados[$campo])==""){
                http_response_code(400);
                echo_json_encode([
                    "erro" =>
                    "O campo $campo é obrigatório e deve ser um texto!"
                ]);
                return null;
            }
    }
    return $dados;
}
function receberIdUsuario(){
    $id = filter_var($_GET["id"] ?? null,
             FILTER_VALIDATE_INT,
             ["options" => ["min_range"=>1]]);
    if($id === false){
        http_response_code(400);
        echo_json_encode([
            "erro" => "informe um id de usuário válido"
        ]);
        return null;
    }
    return $id;
}
function createUsuario($con){
    $dados = receberDadosUsuario();
    if($dados === null){
        return;
    }
    $id = inserir($con,$dados);
    http_response_code(201);
    echo json_encode([
        "mensagem" => "Usuário criado com sucesso",
        "id" => $id
    ]);
}
function readUsuario($con){
    echo json_encode(listar($con));
}
function updateUsuario($con){
    $id = receberIdUsuario();
    if($id === null){
        return;
    }
    $dados = receberDadosUsuario();
    if($dados === null){
        return;
    }
    atualizar($con, $id, $dados);
    echo json_encode([
        "mensagem" => "Senha alterada com sucesso!"
    ]);
}
function deleteUsuario($con){
    $id = receberIdUsuario();
    if($id === null){
        return;
    }
    remover($con, $id);
    echo json_encode([
        "mensagem" => "Usuário removido com sucesso!"
    ]);
}