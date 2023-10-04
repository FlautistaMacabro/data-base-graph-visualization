<?php

session_start();
$_SESSION['bancoEscolhido'] = $_POST['banco'];

require_once 'connectionDBSelected.php';

// Buscando os nomes de todas as tabelas do banco
$nomesTabelas = array();
$query = "SELECT table_name FROM information_schema.tables
          WHERE table_schema = '{$dbname}';";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc())
    array_push($nomesTabelas,$row['table_name']);

// Mostrar ao usuário as opções de tabela...
$_SESSION['nomesTabelas'] = $nomesTabelas;

// Travando configurações adicionais
unset($_SESSION['atributosRelacionadosRestantes']);
unset($_SESSION['registrosDisponiveisRestantes']);

// Travando configurações principais posterioes à próxima
unset($_SESSION['atributosDisp']);
unset($_SESSION['registrosDisponiveis']);
unset($_SESSION['tabelasRelacionadas']);
unset($_SESSION['atributosRelacionados']);
unset($_SESSION['atributoRelacionado']);

header('Location: ../index.php');
exit();

?>