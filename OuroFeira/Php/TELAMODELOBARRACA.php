<?php
session_start();
include('CONEXAO.php');
$id = $_POST['id'];



$sql = "SELECT * FROM barracas WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Barraca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>

<style>
        header {
            padding: 60px 0; /* Ajuste do padding para aumentar a altura */
        }

        .logocanto{
            padding-top: 20px; /* Ajuste o padding superior dos bot�es, se necess�rio */
        }
    </style>


</head>
<body>
    
        <div class="nomeOUROFEIRA">
            <h1 Style="margin-bottom: 50px;">Ouro Feira</h1>
        </div>

        <div class="logocanto">
            <a href="../Php/TELAACESSOCOMPRAS.php">
                <img src="../Imagems/logo.png" alt="Logo Ouro Feira" class="img-fluid" style="max-height: 125px;">
            </a>
        </div>

        <div class="row mb-4 justify-content-center">
            <div class="col-auto">
                <button onclick="window.location.href='../Php/PERFIL.php';" class="btn btn-success">Perfil</button>
                <button onclick="window.location.href='../Php/CARRINHO.php';" class="btn btn-secondary">Carrinho</button>
                <form action="../Php/CARRINHO.php" method="POST" class="d-inline">
                    <button type="submit" name="logout" class="btn btn-primary">Sair</button>
                </form>
                <?php
                if (isset($_SESSION['cargo']) && $_SESSION['cargo'] === 'admin') {
                    echo '<button onclick="window.location.href=\'../html/telaADMIN.html\';" class="btn btn-danger">Painel de ADMIN</button>';
                }
                if (isset($_SESSION['cargo']) && $_SESSION['cargo'] === 'feirante') {
                    echo '<button onclick="window.location.href=\'../html/telaFeirante.html\';" class="btn btn-warning">Painel de Feirante</button>';
                }
                ?>
            </div>
        </div>
    

    <main class="container my-4">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="<?php echo htmlspecialchars($row['imagembarraca'], ENT_QUOTES, 'UTF-8'); ?>" alt="Imagem da Barraca" class="img-fluid rounded">
            </div>
            <div class="col-md-8">
                <h1><?php echo htmlspecialchars($row['nome'], ENT_QUOTES, 'UTF-8'); ?></h1>
                <p><?php echo htmlspecialchars($row['descricao'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        </div>
    </main>

    <section class="container my-5">
      
        <div id="cards-container" class="row g-4">
            <!-- Os cards ser�o carregados aqui -->
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const id = "<?php echo $id; ?>";

            if (!id) {
                console.error("ID n�o definido ou est� vazio.");
                return;
            }

            fetch("../Php/BUSCAPRODUTOS.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${encodeURIComponent(id)}`
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("cards-container").innerHTML = data;
            })
            .catch(error => {
                console.error("Erro ao carregar os dados:", error);
            });
        });
    </script>
</body>
</html>
