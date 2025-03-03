<?php
include('CONEXAO.php');

$pesquisa = $conn->real_escape_string($_POST['pesquisa'] ?? '');
$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT) ?? 1;
$qtd_result_pg = filter_input(INPUT_POST, 'qtd_result_pg', FILTER_SANITIZE_NUMBER_INT) ?? 10;

// Calcula o in cio da visualiza  o
$inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;

// Comando SQL para selecionar os usu rios cadastrados
$sql = "SELECT * 
        FROM usuario 
        WHERE nome LIKE '%$pesquisa%' 
        OR cpf LIKE '%$pesquisa%' 
        OR email LIKE '%$pesquisa%'
        LIMIT $inicio, $qtd_result_pg";


// Executar o comando SQL
$dadosPessoas = $conn->query($sql);
?>
<br><br>
<div class="tabelaVERfeirante">
    <table class="minha-tabela">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endere o</th>
                <th>CPF</th>
                <th>Dados</th>
                <th>A  o</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($exibir = $dadosPessoas->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <?php 
                        if (!empty($exibir["imagemperfil"]) && file_exists($exibir["imagemperfil"])) {
                            echo '<img height="100" src="' . htmlspecialchars($exibir["imagemperfil"], ENT_QUOTES, 'UTF-8') . '" alt="Imagem de perfil">';
                        } else {
                            echo 'Sem foto';
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($exibir["nome"]); ?></td>
                    <td><?php echo htmlspecialchars($exibir["email"]); ?></td>
                    <td><?php echo htmlspecialchars($exibir["telefone"]); ?></td>
                    <td><?php echo htmlspecialchars($exibir["endereco"]); ?></td>
                    <td><?php echo htmlspecialchars($exibir["cpf"]); ?></td>
                    <td>
                        <button type="button" onclick="showUpdatePopup(
                            '<?php echo htmlspecialchars($exibir['nome'], ENT_QUOTES, 'UTF-8'); ?>', 
                            '<?php echo htmlspecialchars($exibir['email'], ENT_QUOTES, 'UTF-8'); ?>', 
                            '<?php echo htmlspecialchars($exibir['telefone'], ENT_QUOTES, 'UTF-8'); ?>', 
                            '<?php echo htmlspecialchars($exibir['endereco'], ENT_QUOTES, 'UTF-8'); ?>', 
                            '<?php echo htmlspecialchars($exibir['cpf'], ENT_QUOTES, 'UTF-8'); ?>'
                        )">Editar</button>
                    </td>
                    <td>
                        <form action="ATUALIZAATIVIDADE.php" method="POST">
                            <select name="opcao" id="opcao" onchange="this.form.submit()">
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                            <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($exibir["cpf"]); ?>">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div id="updatePopup" class="popup" style="display:none;">
        <div class="popup-content">
            <span class="popup-close" onclick="closePopup()">&times;</span>
            <center>
                <h3>Atualizar Usu rio</h3>
                <form action="../Php/ATUALIZARUSER.php" enctype="multipart/form-data" method="POST">
                    <input type="text" name="nome" placeholder="Nome">
                    <input type="text" name="email" placeholder="Email">
                    <input type="text" name="telefone" placeholder="Telefone">
                    <input type="text" name="endereco" placeholder="Endere o">
                    <input type="hidden" name="cpf">
                    <button type="submit">Salvar altera  es</button>
                </form>
            </center>
        </div>
    </div>
</div>

<script>
    function showUpdatePopup(nome, email, telefone, endereco, cpf) {
        // Define os valores dos campos no popup
        document.querySelector('#updatePopup input[name="cpf"]').value = cpf;
        document.querySelector('#updatePopup input[name="endereco"]').value = endereco;
        document.querySelector('#updatePopup input[name="telefone"]').value = telefone;
        document.querySelector('#updatePopup input[name="email"]').value = email;
        document.querySelector('#updatePopup input[name="nome"]').value = nome;

        // Mostra o popup
        document.getElementById('updatePopup').style.display = 'block';
    }

    function closePopup() {
        // Oculta o popup
        document.getElementById('updatePopup').style.display = 'none';
    }
</script>
