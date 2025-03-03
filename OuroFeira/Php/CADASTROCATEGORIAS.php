


<?php

include('CONEXAO.php');




$categoria = $_POST['categoria'];

echo("3");

if(!empty($categoria)){

    
try {
    $sql = "SELECT * FROM categorias WHERE nome='$categoria'";
$result=$conn->query($sql);
if ($result->num_rows == 0) {

$sql = "INSERT INTO categorias (nome) VALUES ('$categoria')";
$result=$conn->query($sql);

header("Location: ../html/telaADMIN.html");
}
$conn->close();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
}else{

    echo "<script>alert('Preencha todos os dados');</script>";
    echo "<script>location = '../html/telaADMIN.html';</script>";	


}

?>