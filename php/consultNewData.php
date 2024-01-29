<?php 

require_once 'connectionDBSelected.php';

// Atributo escolhido pelo usuário
$atributoNovo = $_POST['atributoRelacionadoNovo'];
$tabelaRelacionada = $_SESSION['tabelaRelacionada'];
$atributoRelacionado = $_SESSION['atributoRelacionado'];
$registrosRelacionados = $_SESSION['registrosRelacionados'];

// Caso há 2 registros raízes no grafo
if(isset($_SESSION['registrosSecundariosRelacionados'])){
  $registrosRelacionados = array_merge($registrosRelacionados, $_SESSION['registrosSecundariosRelacionados']);
  $registrosRelacionados = array_unique($registrosRelacionados);
}

$registrosRelacionadosNaoNumerico = array();
$registrosSource = array();
$registrosTarget = array();
$registrosRelacionadosSize = count($registrosRelacionados);

// Verificando se os registros são numéricos
if(!is_numeric($registrosRelacionados[0])){
  for ($i=0; $i < $registrosRelacionadosSize; $i++)
    $registrosRelacionadosNaoNumerico[$i] = "'{$registrosRelacionados[$i]}'";
}else {
  for ($i=0; $i < $registrosRelacionadosSize; $i++)
    $registrosRelacionadosNaoNumerico[$i] = "{$registrosRelacionados[$i]}";
}

// Obtendo os relacionamentos entre os atributos
for ($i=0; $i < $registrosRelacionadosSize; $i++){
  $query = "SELECT {$atributoNovo} FROM {$tabelaRelacionada} WHERE {$atributoRelacionado} like {$registrosRelacionadosNaoNumerico[$i]};";
  $result = $conexao->query($query);
  if($result)
    while($row = $result->fetch_assoc()){
      array_push($registrosSource, $registrosRelacionados[$i]);
      array_push($registrosTarget, $row["{$atributoNovo}"]);
    }
}

/*
// Recolhendo o novo atributo desejado dos registros
$query = "SELECT {$atributoNovo} FROM {$tabelaRelacionada}";

// Query da lista de atributos relacionados para a clausula WHERE
$queryRegistrosRelacionados = " WHERE {$atributoRelacionado} IN ({$registrosRelacionados[0]}";
$sizeRegistrosRelacionados = count($registrosRelacionados);
for($i = 1; $i < $sizeRegistrosRelacionados; $i++){
  $queryRegistrosRelacionados .= ",{$registrosRelacionados[$i]}";
}
$queryRegistrosRelacionados .= ") ";
$query .= $queryRegistrosRelacionados;
$query .= "GROUP BY {$atributoNovo} ORDER BY {$atributoRelacionado} ASC;";

$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc())
    array_push($registrosNewNodes,$row["{$atributoNovo}"]);

// Recolhendo as transições do atributo antigo dos registros para o novo
$query = "SELECT {$atributoNovo} FROM {$tabelaRelacionada}";
$query .= $queryRegistrosRelacionados;
$query .= "ORDER BY {$atributoRelacionado} ASC;";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc())
    array_push($registrosNewEgdes,$row["{$atributoNovo}"]);*/

$_SESSION['atributoRelacionadoNovo'] = $atributoNovo;
$_SESSION['registrosNovoAtributoRelacionadoSource'] = $registrosSource;
$_SESSION['registrosNovoAtributoRelacionadoTarget'] = $registrosTarget;

// É adicionando ao grafo todos os registros como nós relacionados aos registros

header('Location: ../index.php');
exit();
?>