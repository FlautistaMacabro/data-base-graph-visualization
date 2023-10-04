<?php 

require_once 'connectionDBSelected.php';

$_SESSION['tabelaRelacionada'] = $_POST['tabelaRelacionada'];

// O usuário escolhe das tabelas disponíveis
$tabelaRelacionada = $_SESSION['tabelaRelacionada'];

// Listagem dos atributos disponíveis para com esta tabela
$atributosRelationDisp = array();
$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$dbname}' AND TABLE_NAME = '{$tabelaRelacionada}' AND COLUMN_KEY != 'PRI'";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc())
    array_push($atributosRelationDisp,$row['COLUMN_NAME']);

// O usuário deve escolher um atributo em específico...
$_SESSION['atributosRelacionados'] = $atributosRelationDisp;

// Travando configurações adicionais
unset($_SESSION['atributosRelacionadosRestantes']);
unset($_SESSION['registrosDisponiveisRestantes']);
unset($_SESSION['atributoRelacionado']);

header('Location: ../index.php');
exit();
?>