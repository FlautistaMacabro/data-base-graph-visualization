<?php 

$registrosDisponiveis = $_SESSION['registrosDisponiveis'];

// Removendo o registro já escolhido como opção de nova camada de registros
if (($key = array_search($valorRaiz, $registrosDisponiveis)) !== false)
  unset($registrosDisponiveis[$key]);

$_SESSION['registrosDisponiveisRestantes'] = $registrosDisponiveis;

?>