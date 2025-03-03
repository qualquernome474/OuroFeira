<?php
session_start();
include('CONEXAO.php');


// Captura o termo de pesquisa
$query = isset($_GET['query']) ? $_GET['query'] : '';

// Modifica a consulta SQL para incluir o filtro de pesquisa
$sql = "SELECT * FROM barracas WHERE nome LIKE ? OR id LIKE ? OR categoria LIKE ?";
$stmt = $conn->prepare($sql);

// Prepara os par metros para a consulta (evita SQL Injection)
$searchTerm = "%" . $query . "%";
$stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);

// Executa a consulta
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Link para o Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    
    <!-- Link para o seu CSS personalizado -->
    <link rel="stylesheet" href="../css/Style1.css" />

    <script src="../javascript/script.js"></script>
    <title>Barracas</title>
</head>
<body>
    <div class="container mt-0">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-12 col-md-2 text-center mb-3 mb-md-0">
                <img src="../Imagems/logo.png" alt="Logo" class="img-fluid" style="max-height: 125px; width: auto;">
            </div>
            <!-- T tulo -->
            <div class="col-12 col-md-10 text-center">
                <h1>Ouro Feira</h1>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <!-- Linha para os bot es -->
        <div class="row mb-3 justify-content-center">
            <div class="col-12 text-center">
                <form action="../Php/CARRINHO.php" method="POST" class="d-inline-block mb-2">
                    <button type="submit" name="logout" class="btn btn-primary m-2">Sair</button>
                </form>
                <button onclick="window.location.href='../Php/CARRINHO.php';" class="btn btn-secondary m-2 mb-2">Carrinho</button>
                <button onclick="window.location.href='../Php/PERFIL.php';" class="btn btn-success m-2 mb-2">Perfil</button>

                <?php
                if (isset($_SESSION['cargo']) && $_SESSION['cargo'] === 'admin') {
                    echo '<button onclick="window.location.href=\'../html/telaADMIN.html\';" class="btn btn-danger m-2 mb-2">Painel de ADMIN</button>';
                }

                if (isset($_SESSION['cargo']) && $_SESSION['cargo'] === 'feirante') {
                    echo '<button onclick="window.location.href=\'../html/telaFeirante.html\';" class="btn btn-warning m-2 mb-2">Painel de Feirante</button>';
                }
                ?>
            </div>
        </div>

        <!-- Linha para a pesquisa -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 text-center">
                <form action="" method="GET">
                    <input style="background-color:#494949; color: #FD914D;" type="text" name="query" placeholder="Digite sua pesquisa.." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query'], ENT_QUOTES, 'UTF-8') : ''; ?>">
                    <button type="submit" class="card-button">Pesquisar</button>
                </form>
            </div>
        </div>

        <!-- Linha para os cards -->
        <div class="row" id="cards-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $resp = $row['responsavel'];

                    $sql1 = "SELECT * FROM usuario WHERE cpf='$resp'";
                    $result1 = $conn->query($sql1);

                    if ($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        $atividade = $row1['atividade'];

                        if ($atividade == "ativo") {
                            echo '
                            <div class="col-12 col-md-6 col-lg-4 mb-4">
                                <div class="card" style="width: 100%; border: 1px solid #ddd; border-radius: 8px;">
                                    <img src="' . htmlspecialchars($row["imagembarraca"], ENT_QUOTES, 'UTF-8') . '" alt="Card Image" class="card-img-top">
                                    <div class="card-body" style="color: white;">
                                        <h5 class="card-title">Nome: ' . $row["nome"] . '</h5>
                                        <p class="card-text">Descri  o: ' . $row["descricao"] . '</p>
                                        <p class="card-text">Categoria: ' . $row["categoria"] . '</p>
                                        <p class="card-text">ID Da Barraca: ' . $row["id"] . '</p>
                                        <form action="../Php/TELAMODELOBARRACA.php" method="POST">
                                            <input type="hidden" name="nome" value="' . $row["nome"] . '">
                                            <input type="hidden" name="descricao" value="' . $row["descricao"] . '">
                                            <input type="hidden" name="categoria" value="' . $row["categoria"] . '">
                                            <input type="hidden" name="id" value="' . $row["id"] . '">
                                            <button type="submit">Comprar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                }
            } else {
                echo '<p>Nenhum produto encontrado.</p>';
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>