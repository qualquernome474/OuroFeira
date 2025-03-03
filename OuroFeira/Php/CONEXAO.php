<?php

$host = '127.0.0.1'; // Servidor do banco de dados
$dbname = 'ourofeira_db'; // Nome do banco de dados
$usernamedb = 'root'; // Nome de usuário do banco de dados
$passworddb = ''; // Senha do banco de dados


$conn = new mysqli ($host, $usernamedb, $passworddb, $dbname);

if($conn->connect_error){

    echo("Connection failed: ". $conn->connect_error);
}


?>