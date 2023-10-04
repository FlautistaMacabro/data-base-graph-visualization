<?php 

require_once 'connectionDBSelected.php';

$_SESSION['registroRaiz'] = $_POST['registroRaiz'];

// Dado pela interface
$atributoRaiz = $_SESSION['atributoRaiz'];
$entidadeRaiz = $_SESSION['entidadeRaiz'];
$valorRaiz = $_SESSION['registroRaiz'];
// // Buscando primary key da tabela escolhida
// $prKeysRaiz = array();

// $query = "SHOW KEYS FROM {$entidadeRaiz} WHERE Key_name = 'PRIMARY'";
// $result = $conexao->query($query);
// if($result)
//   while($row = $result->fetch_assoc())
//     array_push($prKeysRaiz,$row['Column_name']);

// if(sizeof($prKeysRaiz) > 1)
//   echo "<h2> A entidade raiz NÃO PODE conter mais de uma chave primária !! </h2>";
// else $prKeyRaiz = $prKeysRaiz[0];

/* Buscando as tabela com relações diretas */

// Buscando todas as tabelas que possuem a PK da raiz como estrangeira (1 - n)
$tabelasRelacionadas = array();

$tabelasRelacionadas_1n = array();
$query = "SELECT TABLE_NAME as 'tableNameAux' FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
          WHERE
          REFERENCED_TABLE_SCHEMA = '{$dbname}' AND
          REFERENCED_TABLE_NAME = '{$entidadeRaiz}';";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc()){
    $tableAux = $row['tableNameAux'];
    array_push($tabelasRelacionadas_1n, $tableAux);
    array_push($tabelasRelacionadas, $tableAux);
  }


// Buscando todas as tabelas que a entidade raiz pode se relacionar através de 1 tabela (n - n)
$tabelasRelacionadas_nn = array();
foreach($tabelasRelacionadas as $tabelaAtual) {
  $query = "SELECT REFERENCED_TABLE_NAME as 'tableNameAux' FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
            WHERE 
            TABLE_SCHEMA = '{$dbname}' AND TABLE_NAME = '{$tabelaAtual}' AND 
            REFERENCED_TABLE_NAME is not null AND REFERENCED_TABLE_NAME != '{$entidadeRaiz}';";
  $result = $conexao->query($query);
  if($result)
    while($row = $result->fetch_assoc()){
      $tableAux = $row['tableNameAux'];
      array_push($tabelasRelacionadas_nn, $tableAux);
      array_push($tabelasRelacionadas, $tableAux);
    }
}

// Buscando todas as tabelas que a entidade raiz possui FK (n - 1)
$tabelasRelacionadas_n1 = array();
$query = "SELECT REFERENCED_TABLE_NAME as 'tableNameAux' FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_SCHEMA = '{$dbname}' AND TABLE_NAME = '{$entidadeRaiz}' AND REFERENCED_TABLE_NAME is not null;";
$result = $conexao->query($query);
if($result)
  while($row = $result->fetch_assoc()){
    $tableAux = $row['tableNameAux'];
    array_push($tabelasRelacionadas_n1, $tableAux);
    array_push($tabelasRelacionadas, $tableAux);
  }

// Mostrar ao usuário as tabelas relacionadas...

// O usuário escolhe a entidade desejada...
$_SESSION['tabelasRelacionadas'] = $tabelasRelacionadas;

$_SESSION['tabelasRelacionadas_1n'] = $tabelasRelacionadas_1n;
$_SESSION['tabelasRelacionadas_nn'] = $tabelasRelacionadas_nn;
$_SESSION['tabelasRelacionadas_n1'] = $tabelasRelacionadas_n1;

// Travando configurações adicionais
unset($_SESSION['atributosRelacionadosRestantes']);
unset($_SESSION['registrosDisponiveisRestantes']);

// Travando configurações principais posterioes à próxima
unset($_SESSION['atributosRelacionados']);
unset($_SESSION['atributoRelacionado']);

header('Location: ../index.php');
exit();
?>