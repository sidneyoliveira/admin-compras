<?php

// Incluir a conexao com o banco de dados
include_once './conexao.php';

//Receber os dados da requisão
$dados_requisicao = $_REQUEST;

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
];

// Obter a quantidade de registros no banco de dados
$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM agua";

// // Acessa o IF quando ha paramentros de pesquisa   
// if(!empty($dados_requisicao['search']['value'])) {
//     $query_qnt_usuarios .= " WHERE id LIKE :id ";
//     $query_qnt_usuarios .= " OR nome LIKE :nome ";
//     $query_qnt_usuarios .= " OR salario LIKE :salario ";
//     $query_qnt_usuarios .= " OR idade LIKE :idade ";
// }

// Preparar a QUERY
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);

// // Acessa o IF quando ha paramentros de pesquisa   
// if(!empty($dados_requisicao['search']['value'])) {
//     $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
//     $result_qnt_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
//     $result_qnt_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
//     $result_qnt_usuarios->bindParam(':salario', $valor_pesq, PDO::PARAM_STR);
//     $result_qnt_usuarios->bindParam(':idade', $valor_pesq, PDO::PARAM_STR);
// }

// Executar a QUERY responsável em retornar a quantidade de registros no banco de dados
$result_qnt_usuarios->execute();
$row_qnt_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);
//var_dump($row_qnt_usuarios);

// Recuperar os registros do banco de dados
$query_usuarios = "SELECT id, num_req, setor, sec, item, data, quant, v_unit, v_total, statuss
                    FROM agua ";

// // Acessa o IF quando ha paramentros de pesquisa   
// if(!empty($dados_requisicao['search']['value'])) {
//     $query_usuarios .= " WHERE id LIKE :id ";
//     $query_usuarios .= " OR nome LIKE :nome ";
//     $query_usuarios .= " OR salario LIKE :salario ";
//     $query_usuarios .= " OR idade LIKE :idade ";
// }

// // Ordenar os registros
// $query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " . $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio , :quantidade";

// Preparar a QUERY
$result_usuarios = $conn->prepare($query_usuarios);
// $result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
// $result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

// // Acessa o IF quando ha paramentros de pesquisa   
// if(!empty($dados_requisicao['search']['value'])) {
//     $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
//     $result_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
//     $result_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
//     $result_usuarios->bindParam(':salario', $valor_pesq, PDO::PARAM_STR);
//     $result_usuarios->bindParam(':idade', $valor_pesq, PDO::PARAM_STR);
// }
// Executar a QUERY
$result_usuarios->execute();

// Ler os registros retornado do banco de dados e atribuir no array 
while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    // var_dump($row_usuario);
    extract($row_usuario);
    $registro = [];
    $registro[] = $id;
    $registro[] = $id;

    $dataVar = explode("-", $data);
    $data = $dataVar[2]."/".$dataVar[1]."/".$dataVar[0];
    $registro[] = $data;

    $registro[] = $setor;
    $registro[] = $sec;
    $registro[] = $item;
    $registro[] = $quant;
    // $registro[] = $v_unit;
    $registro[] = "R$ ".$v_total;

    $statusA = array(
        'Enviado' => '<select class="custom-select h-25 py-0 rounded-pill" id="form-status-'.$id.'" onchange="capId('.$id.')">
                <option selected value="1" style="background-color:#fff !important;color:var(--text-color) !important">Enviado</option>
                <option value="2" style="background-color:#fff !important;color:var(--text-color) !important">Visualizado</option>
                <option value="3" style="background-color:#fff !important; color:var(--text-color) !important;">Entregue</option>
                </select>',
        'Visualizado' => '<select class="custom-select h-25 py-0 rounded-pill" id="form-status-'.$id.'" onchange="capId('.$id.')">
                <option value="1" style="background-color:#fff !important;color:var(--text-color) !important">Enviado</option>
                <option selected value="2" style="background-color:#fff !important;color:var(--text-color) !important">Visualizado</option>
                <option value="3" style="background-color:#fff !important; color:var(--text-color) !important;">Entregue</option>
                </select>',
        'Entregue' => '<select class="custom-select h-25 py-0 rounded-pill" id="form-status-'.$id.'" onchange="capId('.$id.')">
                <option value="1" style="background-color:#fff !important;color:var(--text-color) !important">Enviado</option>
                <option value="2" style="background-color:#fff !important;color:var(--text-color) !important">Visualizado</option>
                <option selected value="3" style="background-color:#fff !important; color:var(--text-color) !important;">Entregue</option>
                </select>',        
    );

    $status = $statusA[$statuss];

    $registro[] = $status;
    $dados[] = $registro;
}
//Cria o array de informações a serem retornadas para o Javascript
$resultado = [
    "draw" => intval($dados_requisicao['draw']), // Para cada requisição é enviado um número como parâmetro
    "recordsTotal" => intval($row_qnt_usuarios['qnt_usuarios']), // Quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qnt_usuarios['qnt_usuarios']), // Total de registros quando houver pesquisa
    "data" => $dados // Array de dados com os registros retornados da tabela usuarios
];

// Retornar os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
