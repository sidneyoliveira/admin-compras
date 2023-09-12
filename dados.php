<?php
$mysql = array(
    'server' => 'localhost',
    'user' => 'id21249027_compras',
    'password' => 'Compras@2023',
    'banco' => 'id21249027_admcompras'
);

// Conectando ao banco de dados
$conexao = new mysqli($mysql['server'], $mysql['user'], $mysql['password'], $mysql['banco']);

// Verificando a conexão    
if ($conexao->connect_errno) {
    die("Erro de conexão: " . $conexao->connect_error);
}

$num_req = isset($_POST['num_req']) ? $_POST['num_req'] : "";
$setor = isset($_POST['setor']) ? $_POST['setor'] : "";
$sec = isset($_POST['sec']) ? $_POST['sec'] : "";
$data = isset($_POST['data']) ? $_POST['data'] : "";
$item = isset($_POST['item']) ? $_POST['item'] : "";
$quant = isset($_POST['quant']) ? $_POST['quant'] : "";
$v_unit = isset($_POST['v_unit']) ? $_POST['v_unit'] : "";
$v_total = isset($_POST['v_total']) ? $_POST['v_total'] : "";

$sql = "INSERT INTO agua (num_req, setor, sec, data, item, quant, v_unit, v_total) VALUES ('$num_req', '$setor', '$sec', '$data', '$item', '$quant', '$v_unit', '$v_total')";

if ($conexao->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso";
} else {
    echo "Erro: " . $conexao->errno;
}



$conexao->close();
?>