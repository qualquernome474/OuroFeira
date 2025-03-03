<?php
session_start();
include('CONEXAO.php');
$cpf = $_SESSION["cpf"];



// Obter o idbarraca com base no cpf do respons vel
$sql = "SELECT * FROM barracas WHERE responsavel='$cpf'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$idB = $row['id'];

// Obter os filtros de status e data
$filtroStatus = isset($_GET['filtroStatus']) ? $_GET['filtroStatus'] : '';
$filtroStatus2 = isset($_GET['filtroStatus2']) ? $_GET['filtroStatus2'] : '';
$dataInicio = isset($_GET['dataInicio']) ? $_GET['dataInicio'] : '';
$dataFim = isset($_GET['dataFim']) ? $_GET['dataFim'] : '';

// Construir a consulta SQL com base nos filtros
$sql = "SELECT DISTINCT IDCompra, cpf, dataehora, statuscompra, statuscompraadm, descricao FROM Registro_compras WHERE origem='$idB'";

// Filtro de status do pedido
if ($filtroStatus) {
    $sql .= " AND statuscompra = '$filtroStatus'";
}

// Filtro de status do administrador
if ($filtroStatus2) {
    $sql .= " AND statuscompraadm = '$filtroStatus2'";
}

// Filtro de data
if ($dataInicio && $dataFim) {
    $sql .= " AND dataehora BETWEEN '$dataInicio' AND '$dataFim'";
} elseif ($dataInicio) {
    $sql .= " AND dataehora >= '$dataInicio'";
} elseif ($dataFim) {
    $sql .= " AND dataehora <= '$dataFim'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Verifique se h  resultados
    $products = $result->fetch_all(MYSQLI_ASSOC);
} else {
    // Caso n o haja resultados
   $products = [];
   echo "<script>alert('Nenhuma compra encontrada para os filtros informados.')</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>

 </head>
<body>
<center>
 	                <h1>Ouro feira</h1>
        
      
        <div class="logocanto">
            <a href="../html/telaFeirante.html">
            <img  src="../Imagems/logo.png" alt="" height="125" width="">
            </a>
       </div>
      
    <!-- Bot o para abrir o pop-up -->
    <button id="openPopup">Abrir Filtros</button>
 
</center>
    <!-- Pop-up -->
    <div class="popup-overlay" id="popup">
        <div class="popup-content">
            <button class="close-popup" id="closePopup">Fechar</button>
            <form method="GET" action="">
                <label for="filtroStatus">Status do Pedido:</label>
                <select name="filtroStatus" id="filtroStatus">
                    <option value="">Todos</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Preparando">Preparando</option>
                    <option value="Dispon vel para retirada">Dispon vel para retirada</option>
                </select>

                <label for="filtroStatus2">Status do Administrador:</label>
                <select name="filtroStatus2" id="filtroStatus2">
                    <option value="">Todos</option>
                    <option value="Aguardando Pagamento">Aguardando Pagamento</option>
                    <option value="Dispon vel para retirada">Dispon vel para retirada</option>
                    <option value="Compra cancelada">Compra cancelada</option>
                    <option value="Compra Paga">Compra Paga</option>
                    <option value="Entregue">Entregue</option>
                </select>

                <label for="dataInicio">Data de In cio:</label>
                <input type="date" name="dataInicio" id="dataInicio">

                <label for="dataFim">Data de Fim:</label>
                <input type="date" name="dataFim" id="dataFim">

                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <script>
        // Abrir o pop-up
        document.getElementById('openPopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'flex';
        });

        // Fechar o pop-up
        document.getElementById('closePopup').addEventListener('click', function() {
            document.getElementById('popup').style.display = 'none';
        });

        // Fechar o pop-up ao clicar fora dele
        document.getElementById('popup').addEventListener('click', function(event) {
            if (event.target === this) {
                this.style.display = 'none';
            }
        });
    </script>




    <div class="tabelafeirante">
        <table class="minha-tabela">
            <thead>
                <tr>
                    <th scope="col">ID</th>
		    <th scope="col">CPF</th>
		    <th scope="col">Descricao:</th>
                    <th scope="col">Data e Hora do Pedido</th>
                    <th scope="col">Status do Pedido</th>
                    <th scope="col">Status do Administrador</th> 
                    <th scope="col">Acoes</th>  
                    <th scope="col">Status</th>  
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($products as $product) {
                    echo "<tr>";
                    $IDCompra = $product['IDCompra'];
                    echo "<td>" . htmlspecialchars($product['IDCompra']) . "</td>";
		    echo "<td>" . htmlspecialchars($product['cpf']) . "</td>";
		    echo "<td>" . htmlspecialchars($product['descricao']) . "</td>";
                    echo "<td>" . htmlspecialchars($product['dataehora']) . "</td>";
                    echo "<td>" . htmlspecialchars($product['statuscompra']) . "</td>";
                    echo "<td>" . htmlspecialchars($product['statuscompraadm']) . "</td>";
                    echo "<td><button onclick=\"window.location.href='../Php/VISUALIZARVENDAS.php?IDCompra=$IDCompra'\">Visualizar</button></td>";

                    // Formul rio para alterar status
                    echo '
                    <form action="SALVASTATUS.php" method="POST">
                        <td>
                            <select name="opcao" id="opcao" onchange="this.form.submit()">
                                <option value="Pendente" ' . ($product['statuscompra'] == 'Pendente' ? 'selected' : '') . '>Pendente</option>
                                <option value="Preparando" ' . ($product['statuscompra'] == 'Preparando' ? 'selected' : '') . '>Preparando</option>
                                <option value="Dispon vel para retirada" ' . ($product['statuscompra'] == 'Dispon vel para retirada' ? 'selected' : '') . '>Dispon vel para retirada</option>
                            </select>
                            <input type="hidden" id="IDCompra" name="IDCompra" value="' . $IDCompra . '">
                        </td>
                    </form>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
