<?php

require_once 'connection.php';

// Salvando os nomes de todos os bancos da conexão
$nomesBancos = array();
$query = "SELECT SCHEMA_NAME FROM information_schema.schemata";
$result = mysqli_query($conn, $query);
if($result)
  while($row = $result->fetch_assoc())
    if($row['SCHEMA_NAME'] == "information_schema" || $row['SCHEMA_NAME'] == "phpmyadmin" || $row['SCHEMA_NAME'] == "performance_schema" || $row['SCHEMA_NAME'] == "mysql")
      continue;
    else array_push($nomesBancos,$row['SCHEMA_NAME']);

// Nomes dos bancos na SESSION
$_SESSION['nomesBancos'] = $nomesBancos;

// Travando configurações adicionais
unset($_SESSION['atributosRelacionadosRestantes']);
unset($_SESSION['registrosDisponiveisRestantes']);

// Travando configurações principais posterioes à próxima
unset($_SESSION['nomesTabelas']);
unset($_SESSION['atributosDisp']);
unset($_SESSION['registrosDisponiveis']);
unset($_SESSION['tabelasRelacionadas']);
unset($_SESSION['atributosRelacionados']);
unset($_SESSION['atributoRelacionado']);

header('Location: ../index.php');
exit();

?>