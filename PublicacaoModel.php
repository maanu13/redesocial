<?php
//CREATE
function inserir($con,$dados){
    $stmt = $con->prepare(
        "INSERT INTO PUBLICACOES (id_usuario, legenda, imagem_url)
            VALUES (?,?,?)"
    );
    $stmt -> execute([ $dados["id_usuario"],
                       $dados["legenda"],
                       $dados["imagem_url"]]);
    return $con-> lastInsertId();
}
//READ
function listar($con){
    $stmt = $con -> query("SELECT * FROM publicacoes");
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
//UPDATE
function atualizar($con,$id,$dados){
    $stmt = $con->prepare(
        "UPDATE publicacoes SET legenda = ?
            WHERE id_publicacao =?"
    );
    $stmt -> execute([ $dados["legenda"],
                       $id]);
}
//DELETE
function remover($con,$id){
    $stmt =  $con->prepare(
        "DELETE FROM publicacoes WHERE id_publicacao = ?"
    );
    $stmt -> execute([$id]);
}