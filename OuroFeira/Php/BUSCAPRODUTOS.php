<?php
include('CONEXAO.php');
$id = $_POST['id'];



$sql = "SELECT * FROM produtos WHERE idbarraca='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="container">'; 
    echo '<div class="row justify-content-center">'; // Come�a o grid do Bootstrap
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 mb-4"> <!-- Ajuste de 3 por linha -->
            <div class="card h-100" style="width: 100%; max-width: 350px; margin: 0 auto;"> <!-- Define o card mais largo -->
                <img src="' . htmlspecialchars($row["imagem"], ENT_QUOTES, 'UTF-8') . '" alt="Imagem do Produto" class="card-img-top img-fluid" style="max-height: 200px; object-fit: contain;">
                <div class="card-body" style="color: white;">
                    <h5 class="card-title text-center">' . htmlspecialchars($row["nome"], ENT_QUOTES, 'UTF-8') . '</h5>
                    <p class="card-text">Descri��o: ' . htmlspecialchars($row["descricao"], ENT_QUOTES, 'UTF-8') . '</p>
                    <p class="card-text">Categoria: ' . htmlspecialchars($row["categoria"], ENT_QUOTES, 'UTF-8') . '</p>
                    <p class="card-text">Valor: R$ ' . number_format($row["valor"], 2, ',', '.') . '</p>
                    <p class="card-text">Validade: ' . htmlspecialchars($row["validade"], ENT_QUOTES, 'UTF-8') . '</p>
                    <p class="card-text">Peso: ' . htmlspecialchars($row["peso"], ENT_QUOTES, 'UTF-8') . ' Kg</p>
                    <p class="card-text">Estoque: ' . htmlspecialchars($row["quantidade"], ENT_QUOTES, 'UTF-8') . '</p>

                    <form action="../Php/CARRINHO.php" method="POST">
                        <input type="hidden" name="idproduto" value="' . htmlspecialchars($row["idproduto"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="nome" value="' . htmlspecialchars($row["nome"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="descricao" value="' . htmlspecialchars($row["descricao"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="categoria" value="' . htmlspecialchars($row["categoria"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="valor" value="' . htmlspecialchars($row["valor"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="peso" value="' . htmlspecialchars($row["peso"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="validade" value="' . htmlspecialchars($row["validade"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="quantidade" value="' . htmlspecialchars($row["quantidade"], ENT_QUOTES, 'UTF-8') . '">
                        <input type="hidden" name="idbarraca" value="' . htmlspecialchars($id, ENT_QUOTES, 'UTF-8') . '">

                        <div class="mb-3">
                            <label style="font-size: 25px; for="quantescolhida" class="form-label">Quantidade:</label>
                            <center><input id="quantescolhida" name="quantescolhida" type="number" min="1" max="' . htmlspecialchars($row["quantidade"], ENT_QUOTES, 'UTF-8') . '" class="form-control" required></center>
                        </div>

                        <center><button type="submit">Adicionar ao Carrinho</button></center>
                    </form>
                </div>
            </div>
        </div>';
    }
    echo '</div>'; // Fecha a linha do grid
    echo '</div>'; // Fecha o container
} else {
    echo '<p class="text-center">Nenhum produto encontrado.</p>';
}

$conn->close();
?>
