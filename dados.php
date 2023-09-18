<?php
$mysql = array(
    'server' => 'localhost',
    'user' => 'root',
    'password' => '',
    'banco' => 'celke'
);
// Conectando ao banco de dados
$conexao = new mysqli($mysql['server'], $mysql['user'], $mysql['password'], $mysql['banco']);

// Verificando a conexão    
if ($conexao->connect_errno) {
    die("Erro de conexão: " . $conexao->connect_error);
}

include('arrays.php');

$setorValue = isset($_POST['setor']) ? $_POST['setor'] : "";
$secValue = isset($_POST['sec']) ? $_POST['sec'] : "";
$itemValue = isset($_POST['item']) ? $_POST['item'] : "";



// Usar os valores para obter os nomes correspondentes
$setor = isset($valoresENomesSetor[$setorValue]) ? $valoresENomesSetor[$setorValue] : "";
$sec = isset($valoresENomesSec[$secValue]) ? $valoresENomesSec[$secValue] : "";
$item = isset($valoresENomesItem[$itemValue]) ? $valoresENomesItem[$itemValue] : "";
$v_unit = isset($valoresENomesValor[$itemValue]) ? $valoresENomesValor[$itemValue] : "";

$data = isset($_POST['data']) ? $_POST['data'] : "";
$quant = isset($_POST['quant']) ? $_POST['quant'] : "";

$v_total = $v_unit*$quant;

$sql = "INSERT INTO agua ( setor, sec, data, item, quant, v_unit, v_total) VALUES ( '$setor', '$sec', '$data', '$item', '$quant', '$v_unit', '$v_total')";

if ($conexao->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso\n";

} else {
    echo "Erro: " . $conexao->errno;
}


$conexao->close();

?>