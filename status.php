<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

include_once 'arrays.php';

$statuss = isset($valorStatuss[$dados['statuss']]) ? $valorStatuss[$dados['statuss']] : "";
$id = $dados['id'];

$query_usuario = "UPDATE agua SET statuss=:statuss WHERE id=$id";
$edit_usuario = $conn->prepare($query_usuario);
$edit_usuario->bindParam(':statuss', $statuss);


if($edit_usuario->execute()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>"];
}else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não editado com sucesso!</div>"];
}

echo json_encode($retorna);
