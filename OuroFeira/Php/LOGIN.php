<?php

include('CONEXAO.php');
session_start();

$username = $_POST['email'];
$password = $_POST['senha'];








$sql = "SELECT * FROM usuario WHERE email='$username'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (password_verify($password, $row['senha'])) {
	
     
    $sql = "SELECT * FROM usuario WHERE email='$username'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $cpf = $row['cpf'];
    $atividade = $row['atividade'];
    $_SESSION["cpf"] = $cpf;
    $_SESSION["email"] = $username;


    $cargo=$row['cargo'];
    $_SESSION["cargo"] = $cargo;
    
    if ($row['cargo'] == 'admin' && $atividade=="ativo") {
        
        echo "<script>location = '../html/telaADMIN.html';</script>";
    }
    if ($row['cargo'] == 'feirante' && $atividade=="ativo") {
        
        echo "<script>location = '../html/telaFeirante.html';</script>";
     } else {
        if($atividade=="ativo"){
        echo "<script>location = '../Php/TELAACESSOCOMPRAS.php';</script>";
     }else{
	echo "<script>alert('Usu�rio inativado');</script>";
   	 echo "<script>location = '../html/login.html';</script>";	

}
    }
} else {
    echo "<script>alert('Email ou senha informados incorretos');</script>";
    echo "<script>location = '../html/login.html';</script>";	
}

$conn->close();

?>