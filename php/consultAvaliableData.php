<?php 

require_once 'connectionDBSelected.php';

$_SESSION['atributoRaiz'] = $_POST['atributoRaiz'];

// Atributo escolhido pelo usuário
$atributoRaiz = $_SESSION['atributoRaiz'];
$entidadeRaiz = $_SESSION['entidadeRaiz'];
// Listando todos os registros do atributo da tabela

$registrosDisponiveis = array();
$query = "SELECT {$atributoRaiz} FROM {$entidadeRaiz};";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc())
    array_push($registrosDisponiveis,$row["{$atributoRaiz}"]);

// O usuário escolhe o registro desejado...
$_SESSION['registrosDisponiveis'] = $registrosDisponiveis;

// Travando configurações adicionais
unset($_SESSION['atributosRelacionadosRestantes']);
unset($_SESSION['registrosDisponiveisRestantes']);

// Travando configurações principais posterioes à próxima
unset($_SESSION['atributosRelacionados']);
unset($_SESSION['tabelasRelacionadas']);
unset($_SESSION['atributoRelacionado']);

header('Location: ../index.php');
exit();
?>