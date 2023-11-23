<?php

// Incluir a conexao com o banco de dados
include_once './conexao.php';

//Receber os dados da requisão
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);;

// Lista de colunas da tabela
$colunas = [
    0 => 'id',
    1 => 'req_num',
    2 => 'setor',
    3 => 'sec',
    4 => 'item',
    5 => 'data',
    6 => 'quant',
    7 => 'v_total',
    8 => 'statuss',
    9 => 'id_user'
];

// Recuperar os registros do banco de dados
$query_usuarios = "SELECT id, num_req, setor, sec, item, data, quant, v_unit, v_total, statuss, id_user
                    FROM agua WHERE id=$id ";

// Preparar a QUERY
$result_usuarios = $conn->prepare($query_usuarios);

// Executar a QUERY
$result_usuarios->execute();

// Ler os registros retornado do banco de dados e atribuir no array 
while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    extract($row_usuario);

    $registro = [];
    $registro[] = "00".$id;

    $dataVar = explode("-", $data);
    $data = $dataVar[2]."/".$dataVar[1]."/".$dataVar[0];

    $registro[] = $data;

    $registro[] = $setor;
    $registro[] = $sec;
    $registro[] = $item;
    $registro[] = $quant;
    $registro[] = "R$ ". $v_unit;
    $registro[] = "R$ ".$v_total;
    $registro[] = $id_user;
    $dados[] = $registro;
}
//Cria o array de informações a serem retornadas para o Javascript
$resultado = [
    // "draw" => intval($dados_requisicao['draw']), // Para cada requisição é enviado um número como parâmetro
    "data" => $dados // Array de dados com os registros retornados da tabela usuarios
];

// Retornar os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
