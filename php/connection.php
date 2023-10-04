<?php

#Preencha todas as informações de user e senha no seu arquivo local (Obs: Não suba senha nem conexões no github)
//$dbhost = 'localhost';
$dbhost = 'localhost:3307';

$dbuser = 'root';
$dbpass = '';

$conn = new mysqli($dbhost, $dbuser, $dbpass);

$valueTemp = mysqli_select_db($conn, 'information_schema');

?>