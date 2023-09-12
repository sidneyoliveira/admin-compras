<?php

    $mysql = array(
        'server' => 'localhost',
        'user' => 'id21249027_compras',
        'password' => 'Compras@2023',
        'banco' => 'id21249027_admcompras'
    );

    // Conecte-se ao banco de dados SQL (substitua com suas credenciais)
    $conexao = new mysqli($mysql['server'], $mysql['user'], $mysql['password'], $mysql['banco']);

    // Verifique a conexão
    if ($conexao->connect_error) {
        die("Erro de conexão: " . $conexao->connect_error);
    }

    // Consulta SQL para buscar dados
    $sql = "SELECT * FROM agua";

    $resultado = $conexao->query($sql);

    // Converte os resultados em um array associativo
    $dados = array();
    while ($row = $resultado->fetch_assoc()) {
        $dados[] = $row;
        
    }
    // Fecha a conexão com o banco de dados
    $conexao->close();

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode($dados);
?>
