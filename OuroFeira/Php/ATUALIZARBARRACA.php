<?php
include('CONEXAO.php');
// Obtendo dados do POST
echo("11dfs");

$id = $_POST['id'];
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

$categoria = $_POST['categoria'];
$responsavel = $_POST['responsavel'];

echo("3");



// Verificando se um arquivo foi enviado

if (isset($_FILES['arquivos']) && $_FILES['arquivos']['error'] === UPLOAD_ERR_OK) {
    $pasta = "../Arquivosdeimagem/";
    $nomeDoArquivo = basename($_FILES["arquivos"]["name"]);
    $extensaoDaFoto = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

    if ($_FILES['arquivos']['size'] > 31457280) {
        die("Arquivo muito grande! Max: 30MB");
    }

    if (!in_array($extensaoDaFoto, ["jpg", "jpeg", "png"])) {
        die("Tipo de arquivo n�o aceito.");
    }

    $novoNomeDoArquivo = uniqid() . "." . $extensaoDaFoto;
    $path = $pasta . $novoNomeDoArquivo;

    if (!file_put_contents($path, file_get_contents($_FILES["arquivos"]["tmp_name"]))) {
        die("Erro ao salvar o arquivo.");
    }

    @unlink($_FILES["arquivos"]["tmp_name"]);

    // Atualizando com a imagem
    $sql = "UPDATE barracas SET nome='$nome', descricao='$descricao', categoria='$categoria', imagembarraca='$path' WHERE id = '$id'";

} else {
    // Atualizando sem a imagem
    $sql = "UPDATE barracas SET nome='$nome', descricao='$descricao', categoria='$categoria' WHERE id = '$id'";
}






















$result = $conn->query($sql);

if (!$result) {
    die("Erro ao atualizar os dados: " . $conn->error);
}

$conn->close();

header("Location: ../html/ADMINverbarracas.html?cpf=".$responsavel);
?>
