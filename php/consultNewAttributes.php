<?php 

$atributosRelationDisp = $_SESSION['atributosRelacionados'];

// Removendo o atributo já escolhido como opção de nova camada de registros
if (($key = array_search($atributoRelacionado, $atributosRelationDisp)) !== false)
  unset($atributosRelationDisp[$key]);

$_SESSION['atributosRelacionadosRestantes'] = $atributosRelationDisp;

?>
