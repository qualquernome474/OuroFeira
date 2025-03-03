


<?php


include('CONEXAO.php');



$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$cargo = "feirante";
$codigo = "";


$nomebarraca = $_POST['nomeBarraca'];
$descricao = $_POST['descricao'];
$CategoriasProdutos = $_POST['CategoriasProdutos'];

echo("3");

$senha = password_hash($senha, PASSWORD_DEFAULT);











$pasta = "../Arquivosdeimagem/";
$nomeDoArquivo = basename($_FILES["arquivos1"]["name"]);


$novoNomeDoArquivo = $nomeDoArquivo;
$extensaoDaFoto = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

if (isset($_FILES['arquivos1'])) {
$arquivo = $_FILES['arquivos1'];
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


echo ($_FILES["arquivos1"]["tmp_name"]);
//$deuCerto = move_uploaded_file($_FILES["arquivos1"]["tmp_name"], $nomeDoArquivo);



$deuCerto =file_put_contents($path, file_get_contents($_FILES["arquivos1"]["tmp_name"]));
@unlink($_FILES["arquivos1"]["tmp_name"]);









$pasta = "../Arquivosdeimagem/";
$nomeDoArquivo = basename($_FILES["arquivos2"]["name"]);


$novoNomeDoArquivo = $nomeDoArquivo;
$extensaoDaFoto = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

if (isset($_FILES['arquivos2'])) {
$arquivo = $_FILES['arquivos2'];
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


$path2 = $pasta . $novoNomeDoArquivo;


echo ($_FILES["arquivos2"]["tmp_name"]);
//$deuCerto = move_uploaded_file($_FILES["arquivos2"]["tmp_name"], $nomeDoArquivo);



$deuCerto =file_put_contents($path2, file_get_contents($_FILES["arquivos2"]["tmp_name"]));
@unlink($_FILES["arquivos2"]["tmp_name"]);















if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($cpf) && !empty($senha) && !empty($cargo) && !empty($endereco) && !empty($nomebarraca) && !empty($descricao) && !empty($CategoriasProdutos)){

    
try {
    $sql = "SELECT * FROM usuario WHERE cpf = '$cpf'";
    $result = $conn->query($sql);
    
    $achou = "nao";
    if ($result->num_rows > 0) {
        
        $achou = "sim";

    }
    $atividade="ativo";
    if($achou=="nao"){

        $sql = "INSERT INTO usuario (nome, email, telefone, endereco, cpf, senha, cargo, codigo, imagemperfil, atividade) VALUES ('$nome', '$email', '$telefone', '$endereco', '$cpf', '$senha', '$cargo', '$codigo', '$path2', '$atividade')";
        $result=$conn->query($sql);


        $sql = "INSERT INTO barracas (nome, descricao, categoria, responsavel, imagembarraca) VALUES ('$nomebarraca', '$descricao', '$CategoriasProdutos', '$cpf', '$path')";
        $result=$conn->query($sql);
    }else{
        $sql = "UPDATE usuario SET cargo = 'feirante' WHERE cpf = '$cpf'";
        $result = $conn->query($sql);
       
        $sql = "INSERT INTO barracas (nome, descricao, categoria, responsavel, imagembarraca) VALUES ('$nomebarraca', '$descricao', '$CategoriasProdutos', '$cpf', '$path')";
        $result=$conn->query($sql);
    }
header("Location: ../Php/TELACADASTROFEIRANTE.php");

$conn->close();
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
}else{

    echo "<script>alert('Preencha todos os dados');</script>";
    echo "<script>location = '../html/cadrastofeirante.html';</script>";	


}

?>