<?php

session_start();

include('CONEXAO.php');


$cpf=$_SESSION["cpf"];






$nome = $_POST['nome'];
$preco = $_POST['preco'];
$peso = $_POST['peso'];
$categoria = $_POST['CategoriasProdutos'];
$validade = $_POST['validade'];
$quantidade = $_POST['quantidade'];
$descricao = $_POST['descricao'];

// echo "<script>alert('$cpf');</script>";
// echo "<script>alert('$nome');</script>";
// echo "<script>alert('$preco');</script>";
// echo "<script>alert('$peso');</script>";
// echo "<script>alert('$categoria');</script>";
// echo "<script>alert('$validade');</script>";
// echo "<script>alert('$quantidade');</script>";
// echo "<script>alert('$descricao');</script>";


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



//$deuCerto = move_uploaded_file($_FILES["arquivos"]["tmp_name"], $nomeDoArquivo);



$deuCerto =file_put_contents($path, file_get_contents($_FILES["arquivos"]["tmp_name"]));
@unlink($_FILES["arquivos"]["tmp_name"]);

if (true) {
/*$sql = "INSERT INTO Imagems_Produtos ( idproduto, id,pathdaimagem, dataupload, idusuario) VALUES ('','','$path','','')";
echo $sql;*/

$sql = "SELECT * FROM barracas WHERE responsavel='$cpf'";
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();
    $idbarraca = $row['id'];
   




    
} else {
  
}


if(!empty($nome) && !empty($preco) && !empty($peso) && !empty($categoria) && !empty($validade) && !empty($quantidade) && !empty($descricao)&& !empty($path)){


    try {
       
    
        $sql = "INSERT INTO produtos (nome, validade, descricao, valor, quantidade, categoria, peso, idbarraca, imagem) VALUES ('$nome', '$validade', '$descricao', '$preco', '$quantidade', '$categoria', '$peso', '$idbarraca', '$path')";

       
        $result=$conn->query($sql);
   
    echo "<script>alert ('produto cadrastado');</script>;";
    echo "<script>location = '../Php/TELACADASTRARPRODUTOS.php';</script>";	
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
    }else{
    
        echo "<script>alert('Preencha todos os dados');</script>";
        echo "<script>location = '../Php/TELACADASTRARPRODUTOS.php';</script>";	
    
    
    }
$conn->close();
?>