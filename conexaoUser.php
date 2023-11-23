<?php

$usuario = 'freedb_compras';
$senha = '25CrUX3#@bcB&Au';
$database = 'freedb_adm-compras';
$host = 'sql.freedb.tech';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}