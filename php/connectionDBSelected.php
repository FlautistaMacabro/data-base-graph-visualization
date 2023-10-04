<?php
if(session_status() != 2)
  session_start();

//$dbhost = 'localhost';
$dbhost = 'localhost:3307';

$dbuser = 'root';
$dbpass = '';

// Dado pela interface
$dbname = $_SESSION['bancoEscolhido'];

$conexao = new mysqli($dbhost, $dbuser, $dbpass);

$value = mysqli_select_db($conexao, $dbname);

?>