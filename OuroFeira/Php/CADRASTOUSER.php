


<?php



include('CONEXAO.php');


$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$cargo = "comum";
$codigo = "";

echo("3");

$senha = password_hash($senha, PASSWORD_DEFAULT);



$pasta = "../Arquivosdeimagem/";
$nomeDoArquivo = basename($_FILES["arquivos"]["name"]);


$novoNomeDoArquivo = $nomeDoArquivo;
$extensaoDaFoto = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

if (isset($_FILES['arquivos'])) {
$arquivo = $_FILES['arquivos'];
if ($arquivo['size'] > 31457280 ) {
    die("Arquivo muito grande! Max: 30MB");
}

    if ($extensaoDaFoto != "jpg" && $extensaoDaFoto != 'png' && $extensaoDaFoto != 'PNG' && $extensaoDaFoto != 'JPG' && $extensaoDaFoto != 'jpeg' ) {
    echo "<script>alert ('Tipo de arquivo n o aceito');</script>;"; 
}
}

/*
if ($arquivo['error'] !== UPLOAD_ERR_OK) {
    echo "<script>alert ('Erro no upload do arquivo:  . $arquivo['error']');</script>;";
}

if (!file_exists($pasta)) {
    echo "<script>alert ('A pasta de destino n o existe.');</script>;"; 
}

if (!is_writable($pasta)) {
    echo "<script>alert ('A pasta de destino n o tem permiss es de escrita.');</script>;"; 
}

if (!is_uploaded_file($arquivo["tmp_name"])) {
    echo "<script>alert ('O arquivo n o foi enviado corretamente. /n tente novamente.');</script>;";
}

*/


$path = $pasta . $novoNomeDoArquivo;


echo ($_FILES["arquivos"]["tmp_name"]);
//$deuCerto = move_uploaded_file($_FILES["arquivos"]["tmp_name"], $nomeDoArquivo);



$deuCerto =file_put_contents($path, file_get_contents($_FILES["arquivos"]["tmp_name"]));
@unlink($_FILES["arquivos"]["tmp_name"]);



if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($cpf) && !empty($senha) && !empty($cargo) && !empty($endereco)){

    
try {
    $sql = "INSERT INTO usuario (nome, email, telefone, endereco, cpf, senha, cargo, codigo, imagemperfil, atividade) VALUES ('$nome', '$email', '$telefone', '$endereco', '$cpf', '$senha', '$cargo', '$codigo', '$path', 'ativo')";
$result=$conn->query($sql);

header("Location: ../index.html");

$conn->close();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
}else{

    echo "<script>alert('Preencha todos os dados');</script>";
    echo "<script>location = '../html/cadastro.html';</script>";	


}

?>