<?php

include('CONEXAO.php');

    $pasta = "../Arquivosdeimagem/";
    $nomeDoArquivo = $pasta . basename($_FILES["arquivos"]["name"]);
    echo $nomeDoArquivo;
$uploadOK = 1;

    $novoNomeDoArquivo = uniqid();
    $extensaoDaFoto = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

   if (isset($_FILES['arquivos'])) {
    $arquivo = $_FILES['arquivos'];
    if ($arquivo['size'] > 31457280 ) {
        die("Arquivo muito grande! Max: 30MB");
    }

        if ($extensaoDaFoto != "jpg" && $extensaoDaFoto != 'png' && $extensaoDaFoto != 'PNG' && $extensaoDaFoto != 'JPG' && $extensaoDaFoto != 'jpeg' ) {
        echo("Tipo de arquivo n�o aceito");
	}
    
	if ($arquivo['error'] !== UPLOAD_ERR_OK) {
    	echo("Erro no upload do arquivo: " . $arquivo['error']);
	}

	if (!file_exists($pasta)) {
    	echo("A pasta de destino n�o existe.");
	}

	if (!is_writable($pasta)) {
    	echo("A pasta de destino n�o tem permiss�es de escrita.");
	}

	if (!is_uploaded_file($arquivo["tmp_name"])) {
    	echo("O arquivo n�o foi enviado corretamente.");
	}
echo "<BR>";

    $path = $pasta . $novoNomeDoArquivo . "." . $extensaoDaFoto;
echo($path = $pasta . $novoNomeDoArquivo . "." . $extensaoDaFoto);
echo "<script>alert ('imagem cadrastada');</script>;";
echo ($_FILES["arquivos"]["tmp_name"]);
    $deuCerto = move_uploaded_file($_FILES["arquivos"]["tmp_name"], $nomeDoArquivo);
	
echo($deuCerto);

    if (true) {
	$sql = "INSERT INTO Imagems_Produtos (pathdaimagem) VALUES ('$path')";
	echo $sql;
        $mysqli->query($sql);
        echo "<p>Arquivo enviado com sucesso!</p>";
    } else {
        echo "<p>Falha ao enviar arquivo!</p>";
    }
}



?>
