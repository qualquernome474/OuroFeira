<?php
include('CONEXAO.php');

$pesquisa = $conn->real_escape_string($_POST['pesquisa']);
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qtd_result_pg = filter_input(INPUT_POST, 'qtd_result_pg', FILTER_SANITIZE_NUMBER_INT);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);

// Calcular o inÃ­cio da visualizaÃ§Ã£o
$inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;

// Comando SQL para selecionar as barracas
$sql = "SELECT * FROM barracas WHERE responsavel='$cpf'";

// Executar o comando SQL
$dadosPessoas = $conn->query($sql);

$resp='';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        </head>
<body>

<div class="container mt-4">
        <br>
 	<div class="tabelafeirante">
        <table class="minha-tabela">  
        <thead>
            <tr>
                <th>Id</th>
                <th>Foto</th>
                <th>Nome da Barraca</th>
                <th>DescriÃ§Ã£o</th>
                <th>Categoria</th>
                <th>ResponsÃ¡vel</th>
                <th>AÃ§Ãµes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($dadosPessoas->num_rows > 0) {
                while ($exibir = $dadosPessoas->fetch_assoc()) {
                    $resp=$exibir["responsavel"];
                    echo "<tr>
                            <td>" . $exibir["id"] . "</td>
			    <td><img src='" . htmlspecialchars($exibir["imagembarraca"], ENT_QUOTES, 'UTF-8') . "' alt='Imagem da Barraca' style='max-width: 100px;'></td>
                            <td>" . $exibir["nome"] . "</td>
                            <td>" . $exibir["descricao"] . "</td>
                            <td>" . $exibir["categoria"] . "</td>
                            <td>" . $exibir["responsavel"] . "</td>
                            
                            <td>
                                <button class='btn btn-primary' onclick='showUpdatePopup(" .
                                htmlspecialchars($exibir['id']) . ", \"" .
                                htmlspecialchars($exibir['nome']) . "\", \"" .
                                htmlspecialchars($exibir['descricao']) . "\", \"" .
                                htmlspecialchars($exibir['categoria']) . "\")'>Editar</button>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Nenhum registro encontrado.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <div id="updatePopup" class="popup">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <center>
                <h3>Atualizar Barraca</h3>
                <form action="../Php/ATUALIZARBARRACA.php" enctype="multipart/form-data" method="POST">
		    <input type="hidden" id="id" name="id">
                    <input type="text" id="nome" name="nome" placeholder="Nome da barraca" required>
                    <input type="text" id="descricao" name="descricao" placeholder="DescriÃ§Ã£o" required>
                    <input type="text" id="categoria" name="categoria" placeholder="Categoria" required>
                    <input type="hidden" id="responsavel" name="responsavel" value="<?php echo htmlspecialchars($resp, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Responsável" required>

                    
                    <input name="arquivos" type="file">
                    <button type="submit" class="btn btn-success">Salvar alteraÃ§Ãµes</button>
                </form>
            </center>
        </div>
    </div>
</div>

<script>
    function showUpdatePopup(id, nome, descricao, categoria) {
        document.getElementById('id').value = id;
        document.getElementById('nome').value = nome;
        document.getElementById('descricao').value = descricao;
        document.getElementById('categoria').value = categoria;
        document.getElementById('updatePopup').style.display = 'block';
    }

    function closePopup() {
        document.getElementById('updatePopup').style.display = 'none';
    }
</script>

</body>
</html>
