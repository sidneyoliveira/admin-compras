<?php 

// Incluir a conexao com o banco de dados
include_once './conexao.php';

//Receber os dados da requisão
$id_user = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);;

// Lista de colunas da tabela
$colunas = [
    0 => 'id',
    1 => 'nome',
    2 => 'cargo',
    3 => 'cpf',
];

// Recuperar os registros do banco de dados
$query_usuarios = "SELECT id, nome, cargo, cpf
                    FROM data_users WHERE id=$id_user ";

// Preparar a QUERY
$result_usuarios = $conn->prepare($query_usuarios);

// Executar a QUERY
$result_usuarios->execute();

// Ler os registros retornado do banco de dados e atribuir no array 
while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
    extract($row_usuario);

    $registro[] = $id;
    $registro[] = $nome;
    $registro[] = $cargo;
    $registro[] = $cpf;

    $users[] = $registro;
}

$resultado = [
    "users" => $users 
];

echo json_encode($resultado);
