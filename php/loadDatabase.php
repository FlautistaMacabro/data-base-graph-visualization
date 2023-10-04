<?php

require_once 'connection.php';

// Dado pela interface
$sqlFileLocation = $target_file;

$querysIniciais = file_get_contents($sqlFileLocation);

if(!$querysIniciais){
  echo "<h2>Algo deu errado</h2>";
}

$conn->multi_query($querysIniciais);

do {
  $conn->use_result();
}
while ($conn->next_result());

// Esvaziando buffer de query


require_once 'consultAvaliableDataBases.php';
?>