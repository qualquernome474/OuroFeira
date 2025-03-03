<?php

include('CONEXAO.php');

    $pesquisa = $conn->real_escape_string($_POST['pesquisa']);
    $pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $qtd_result_pg = filter_input(INPUT_POST, 'qtd_result_pg', FILTER_SANITIZE_NUMBER_INT);

    //echo $qtd_result_pg;
    //calcula o inicio da visualiza  o
    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;
    //echo $pagina;
    //comando sql para selecionar as pessoas cadastradas

  $sql = "SELECT * 
        FROM usuario 
        WHERE (nome LIKE '%$pesquisa%' OR cpf LIKE '%$pesquisa%' OR email LIKE '%$pesquisa%') 
          AND cargo = 'feirante'";
  
    //executar o comando sql
    $dadosPessoas = $conn->query($sql);

?>
<br><br>
<div class="tabelaVERfeirante">
<table class="minha-tabela">
    <thead>
		
        <tr>
	    <th>Foto do feirante</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Endere o</th>
            <th>CPF</th>
            <th>Barraca</th>
            <th></th>
       
           
        </tr>
	
    </thead>
    <tbody>
</div>

        <?php

            while ($exibir = $dadosPessoas->fetch_assoc()) { //fetch_assoc() retorna cada linha da matriz
            ?>
        <tr>
            <td><?php 
        // Verificar se o campo imagemperfil n�o est� vazio ou se o caminho � v�lido
        if (!empty($exibir["imagemperfil"]) && file_exists($exibir["imagemperfil"])) {
            // Se houver um caminho de imagem v�lido, exibe a imagem
            echo '<img height="100" src="' . htmlspecialchars($exibir["imagemperfil"], ENT_QUOTES, 'UTF-8') . '" alt="Imagem de perfil">';
        } else {
            // Se n�o houver imagem, exibe uma mensagem alternativa
            echo 'Sem foto';
        }
        ?></td>

            <td><?php echo $exibir["nome"] ?> </td>
            <td><?php echo $exibir["email"] ?> </td>
            <td><?php echo $exibir["telefone"] ?> </td>
            <td><?php echo $exibir["endereco"] ?> </td>
            <td><?php echo $exibir["cpf"] ?> </td>
            <td><a href="../html/ADMINverbarracas.html?cpf=<?php echo $exibir["cpf"] ?>">Acessar</a></td>
            
            <td>
                <a href="#" onclick="confirmarExclusao('<?php echo $exibir["cpf"] ?>',
                        '<?php echo $exibir["nome"] ?>')">Excluir</a>
            </td>

        </tr>

        <?php
            }

            ?>
    </tbody>
</table>
