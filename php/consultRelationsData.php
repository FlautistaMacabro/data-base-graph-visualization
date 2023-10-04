<?php 

require_once 'connectionDBSelected.php';

$_SESSION['atributoRelacionado'] = $_POST['atributoRelacionado'];

// Atributo escolhido pelo usuário
$entidadeRaiz = $_SESSION['entidadeRaiz'];
$atributoRaiz = $_SESSION['atributoRaiz'];
$valorRaiz = $_SESSION['registroRaiz'];
$atributoRelacionado = $_SESSION['atributoRelacionado'];
$tabelaRelacionada = $_SESSION['tabelaRelacionada'];

// Verificando se o registro é numérico
if(!is_numeric($valorRaiz))
  $valorRaizNaoNumerico = "'{$valorRaiz}'";

$registrosRelationDisp = array();
// Verificando se a relação é (1 - n)
if(in_array($tabelaRelacionada, $_SESSION['tabelasRelacionadas_1n'])){
  $query = "SELECT COLUMN_NAME as 'relacionadaFK', REFERENCED_COLUMN_NAME as 'raizPK' FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA like '{$dbname}' AND TABLE_NAME like '{$tabelaRelacionada}' AND REFERENCED_TABLE_NAME like '{$entidadeRaiz}'";
  $result = $conexao->query($query);
  if($result){
    while($row = $result->fetch_assoc()){
      $tabelaRelacionadaFK = $row['relacionadaFK'];
      $tabelaRaizPK = $row['raizPK'];
    }
  }

  $query = "SELECT {$tabelaRelacionada}.{$atributoRelacionado} from {$tabelaRelacionada}
    inner join {$entidadeRaiz}
    on {$tabelaRelacionada}.{$tabelaRelacionadaFK} = {$entidadeRaiz}.{$tabelaRaizPK}
  where {$entidadeRaiz}.{$atributoRaiz} = {$valorRaizNaoNumerico}
  GROUP BY {$tabelaRelacionada}.{$atributoRelacionado}
  ORDER BY {$tabelaRelacionada}.{$atributoRelacionado} ASC";

  // Verificando se a relação é (n - 1)
} elseif(in_array($tabelaRelacionada, $_SESSION['tabelasRelacionadas_n1'])) {
  $query = "SELECT COLUMN_NAME as 'raizFK', REFERENCED_COLUMN_NAME as 'relacionadaPK' FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA like '{$dbname}' AND TABLE_NAME like '{$entidadeRaiz}' AND REFERENCED_TABLE_NAME like '{$tabelaRelacionada}'";
  $result = $conexao->query($query);
  if($result){
    while($row = $result->fetch_assoc()){
      $tabelaRelacionadaPK = $row['relacionadaPK'];
      $tabelaRaizFK = $row['raizFK'];
    }
  }

  $query = "SELECT {$tabelaRelacionada}.{$atributoRelacionado} from {$tabelaRelacionada}
    inner join {$entidadeRaiz}
    on {$tabelaRelacionada}.{$tabelaRelacionadaPK} = {$entidadeRaiz}.{$tabelaRaizFK}
  where {$entidadeRaiz}.{$atributoRaiz} = {$valorRaizNaoNumerico}
  GROUP BY {$tabelaRelacionada}.{$atributoRelacionado}
  ORDER BY {$tabelaRelacionada}.{$atributoRelacionado} ASC";

} else {
  // A relação é (n - n)
  $tabelasRelacionamentoPossiveis = array();
  $query = "SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA like '{$dbname}' AND REFERENCED_TABLE_NAME like '{$tabelaRelacionada}'";
  $result = $conexao->query($query);
  if($result){
    while($row = $result->fetch_assoc())
      array_push($tabelasRelacionamentoPossiveis,[$row['TABLE_NAME'], $row['COLUMN_NAME'], $row['REFERENCED_COLUMN_NAME']]);
  }

  $query = "SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA like '{$dbname}' AND REFERENCED_TABLE_NAME like '{$entidadeRaiz}'";
  $result = $conexao->query($query);
  if($result){
    while($row = $result->fetch_assoc())
      foreach($tabelasRelacionamentoPossiveis as $tabelaRelacionamentoPossivel)
        if($row['TABLE_NAME'] == $tabelaRelacionamentoPossivel[0]){
          $tabelaRelacionamento = $tabelaRelacionamentoPossivel[0];
          $chaveRelacionamento = $tabelaRelacionamentoPossivel[1];
          $chaveRelacionada = $tabelaRelacionamentoPossivel[2];
          $chaveRelacionamentoRaiz = $row['COLUMN_NAME'];
          $chaveRaiz = $row['REFERENCED_COLUMN_NAME'];
          break;
        }
  }

  $query = "SELECT {$tabelaRelacionada}.{$atributoRelacionado} from {$tabelaRelacionada}
  inner join {$tabelaRelacionamento}
    on {$tabelaRelacionada}.{$chaveRelacionada} = {$tabelaRelacionamento}.{$chaveRelacionamento}
      inner join {$entidadeRaiz}
      on {$tabelaRelacionamento}.{$chaveRelacionamentoRaiz} = {$entidadeRaiz}.{$chaveRaiz}
  where {$entidadeRaiz}.{$atributoRaiz} = {$valorRaizNaoNumerico}
  GROUP BY {$tabelaRelacionada}.{$atributoRelacionado}
  ORDER BY {$tabelaRelacionada}.{$atributoRelacionado} ASC";
}

$result = $conexao->query($query);
if($result){
  while($row = $result->fetch_assoc())
    array_push($registrosRelationDisp,$row["{$atributoRelacionado}"]);
}


/*

/*
SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA like '{$dbname}' AND REFERENCED_TABLE_NAME like '{$tabelaRelacionada}';*/

// $tabelaRelacionamento = TABLE_NAME
// $chaveRelacionamento = COLUMN_NAME
// $chaveRelacionada = REFERENCED_COLUMN_NAME

/*
SELECT TABLE_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA like '{$dbname}' AND TABLE_NAME like 'filme_genero' AND REFERENCED_TABLE_NAME like '{$entidadeRaiz}';*/

/* if(TABLE_NAME == $tabelaRelacionamento)
    para o loop q tá certo
   else continua o loop

   $chaveRelacionamentoRaiz = COLUMN_NAME
   $chaveRaiz = REFERENCED_COLUMN_NAME

/*
SELECT {$tabelaRelacionada}.{$atributoRelacionado} from {$tabelaRelacionada}
inner join {$tabelaRelacionamento}
	on {$tabelaRelacionada}.{$chaveRelacionada} = {$tabelaRelacionamento}.{$chaveRelacionamento}
    inner join {$entidadeRaiz}
    on {$tabelaRelacionamento}.{$chaveRelacionamentoRaiz} = {$entidadeRaiz}.{$chaveRaiz}
where {$entidadeRaiz}.{$atributoRaiz} = '{$valorRaiz}'
GROUP BY {$atributoRelacionado}
ORDER BY {$atributoRelacionado} ASC;
*/
/*
$registrosRelationDisp = array();
$query = "SELECT {$atributoRelacionado} FROM {$tabelaRelacionada} GROUP BY {$atributoRelacionado} ORDER BY  {$atributoRelacionado} ASC;";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc())
    array_push($registrosRelationDisp,$row["{$atributoRelacionado}"]);*/

// É adicionando ao grafo todos os registros como nós relacionados a raiz
$_SESSION['registrosRelacionados'] = $registrosRelationDisp;

// Atualizando uma lista de atributos a serem escolhidos além do já escolhido
require_once 'consultNewAttributes.php';

// Atualizando uma lista de registros a serem escolhidos além do já escolhido
require_once 'consultAvaliableNodes.php';

// Apagar nós e arestas já salvos pelas secções anteriores das configurações adicionais
unset($_SESSION['registrosNovoAtributoRelacionadoSource']);
unset($_SESSION['registrosSecundariosRelacionados']);

header('Location: ../index.php');
exit();
?>