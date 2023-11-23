<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

include_once 'arrays.php';

$setor = isset($valoresENomesSetor[$dados['setor']]) ? $valoresENomesSetor[$dados['setor']] : "";
$sec = isset($valoresENomesSec[$dados['sec']]) ? $valoresENomesSec[$dados['sec']] : "";
$item = isset($valoresENomesItem[$dados['item']]) ? $valoresENomesItem[$dados['item']] : "";
$v_unit = isset($valoresENomesValor[$dados['item']]) ? $valoresENomesValor[$dados['item']] : "";
$data = $dados['data'];
$quant = $dados['quant'];


$v_unit = floatval($v_unit);
$quant = intval($quant);


$v_total = $v_unit*$quant;
$statuss = "Enviado";



if(!isset($_SESSION)) {
    session_start();
}
$id_user = $_SESSION['id'];


if (empty($dados['quant'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo quantidade!</div>"];
} elseif (empty($dados['data'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo data!</div>"];
} else {
    $query_usuario = "INSERT INTO agua (num_req, setor, sec, data, item, quant, v_unit, v_total, statuss, id_user) VALUES (:num_req, :setor, :sec, :data, :item, :quant, :v_unit, :v_total, :statuss, :id_user)";
    $cad_usuario =$conn->prepare($query_usuario);
    $cad_usuario->bindParam(':num_req', $data);
    $cad_usuario->bindParam(':setor', $setor);
    $cad_usuario->bindParam(':sec', $sec);
    $cad_usuario->bindParam(':item', $item );
    $cad_usuario->bindParam(':data', $data);
    $cad_usuario->bindParam(':quant', $quant);
    $cad_usuario->bindParam(':v_unit', $v_unit);
    $cad_usuario->bindParam(':v_total', $v_total);
    $cad_usuario->bindParam(':statuss', $statuss);
    $cad_usuario->bindParam(':id_user', $id_user);

    $cad_usuario->execute();
    
    if($cad_usuario->rowCount()){
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>"];
    }else{
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Usuário não cadastrado com sucesso!</div>"];
    }

}
echo json_encode($retorna);
