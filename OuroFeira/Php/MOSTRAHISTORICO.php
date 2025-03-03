<?php
session_start();
include('CONEXAO.php');
$cpf = $_SESSION["cpf"];




// Obter o idbarraca com base no cpf do responsável


$sql = "SELECT DISTINCT IDCompra, dataehora, statuscompra, statuscompraadm FROM Registro_compras WHERE cpf='$cpf'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    

    // Verifique se há resultados
    if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $products = [];
    }
} else {
    // Caso o cpf não esteja associado a uma barraca
    $products = [];
    echo "<p>Nenhuma barraca encontrada para o CPF informado.</p>";
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadastrados</title>
    <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>
</head>
<body>
               <center><h1 style="color: #FD914D;">Ouro Feira</h1></center>
        
        <div class="logocanto">
            <a href="../Php/PERFIL.php">
                <img src="../Imagems/logo.png" alt="Logo Ouro Feira" height="125">
            </a>
        </div>
    

    <form id="form-pesquisa" action="" method="post">
        <div class="centarlizaPesqiusa">
            <div class="search-container">
                <input style="background-color:#494949; color:#FD914D;" type="text" size="50" name="pesquisa" id="pesquisa" placeholder="Digite sua pesquisa...">
                <button type="submit" name="btnEnviar" id="btnEnviar" value="Pesquisar" class="card-button">Pesquisar</button>
            </div>
        </div>
    </form>

    <div class="tabelafeirante">
        <table class="minha-tabela">
            <thead>
                <tr>
                   
	            <th scope="col">ID</th>
		    <th scope="col">Data e Hora do Pedido</th>
	            <th scope="col">Status do Pedido</th>
                <th scope="col">Status do Administrador</th> 
		    <th scope="col">A��es</th>  	
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
foreach ($products as $product) {
    echo "<tr>";
    $IDCompra=$product['IDCompra'];
    echo "<td>" . htmlspecialchars($product['IDCompra']) . "</td>";
    echo "<td>" . htmlspecialchars($product['dataehora']) . "</td>";
    echo "<td>" . htmlspecialchars($product['statuscompra']) . "</td>";
    echo "<td>" . htmlspecialchars($product['statuscompraadm']) . "</td>";
    echo "<td><button onclick=\"window.location.href='../Php/NOTINHA.php?IDCompra=$IDCompra'\">Visualizar</button></td>";
   
    
   
    echo "</tr>";
}
?>
            </tbody>
        </table>
    </div>

   

   
</body>
</html>

