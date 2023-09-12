<?php
// Essa select abaixo tem que buscar a cada 5 segundos sem atualizar a página
$selecionaTabela = mysql_query("SELECT * FROM agua")or die(mysql_error());
// Fecha Select

$verifica = mysql_num_rows($selecionaTabela);
if($verifica >= 1){
   $dados = mysql_fetch_array($selecionaTabela);
   print_r($dados);
}