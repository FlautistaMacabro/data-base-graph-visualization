<?php 

require_once 'connectionDBSelected.php';
$_SESSION['entidadeRaiz'] = $_POST['tabela'];

// Escolha de tabela pelo usuário
$entidadeRaiz = $_SESSION['entidadeRaiz'];

// Listagem dos atributos disponíveis para com esta tabela
$atributosDisp = array();
$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '{$dbname}' AND TABLE_NAME = '{$entidadeRaiz}' AND COLUMN_KEY != 'PRI'";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc())
    array_push($atributosDisp,$row['COLUMN_NAME']);

// O usuário deve escolher um atributo em específico...

$_SESSION['atributosDisp'] = $atributosDisp;

// Travando configurações adicionais
unset($_SESSION['atributosRelacionadosRestantes']);
unset($_SESSION['registrosDisponiveisRestantes']);

// Travando configurações principais posterioes à próxima
unset($_SESSION['registrosDisponiveis']);
unset($_SESSION['tabelasRelacionadas']);
unset($_SESSION['atributosRelacionados']);
unset($_SESSION['atributoRelacionado']);

header('Location: ../index.php');
exit();

?>