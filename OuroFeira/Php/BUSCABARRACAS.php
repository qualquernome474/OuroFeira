<?php

include('CONEXAO.php');






$sql = "SELECT * FROM barracas";
$result=$conn->query($sql);


$sql = "SELECT * FROM barracas";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
        <div class="col-12 col-md-6 col-lg-4 mb-5">
            <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 5px;">
                <img src="' . htmlspecialchars($row["imagembarraca"], ENT_QUOTES, 'UTF-8') . '" alt="Card Image" class="card-img-top">
                <div class="card-body">
                    <center>
                    <h5 class="card-title">Nome: ' . $row["nome"] . '</h5>
                    <p class="card-text">Descrição: ' . $row["descricao"] . '</p>
                    <p class="card-text">Categoria: ' . $row["categoria"] . '</p>
                    <p class="card-text">ID Da Barraca: ' . $row["id"] . '</p>
                    <form action="../Php/TELAMODELOBARRACA.php" method="POST">
                        <input type="hidden" name="nome" value="' . $row["nome"] . '">
                        <input type="hidden" name="descricao" value="' . $row["descricao"] . '">
                        <input type="hidden" name="categoria" value="' . $row["categoria"] . '">
                        <input type="hidden" name="id" value="' . $row["id"] . '">
                        <button type="submit">Comprar</button>
                    </form>
                    </center>
                </div>
            </div>
        </div>';
    }
} else {
    echo '<p>Nenhum produto encontrado.</p>';
}

$conn->close();

?>