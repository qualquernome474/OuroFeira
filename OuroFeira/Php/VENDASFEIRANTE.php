<?php
include('CONEXAO.php');


$sql = "SELECT * FROM Registro_compras";
$result = $conn->query($sql);

$row = $result->fetch_assoc();

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos Cadrastados</title>

        <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>
</head>
<body>
<html>
<div class="barralogoResp">
        <div class="barralogo ">
            <h1 style="color: #FD914D;">Ouro feira</h1>
        </div>

        <div class="logocanto">
            <a href="../html/telaFeirante.html">
                <img src="../Imagems/logo.png" alt="" height="125" width="">
            </a>
        </div>
    </div>
<center>
<h1>Vendas Do Dia </h1>
</center>

<div class ="tabelafeirante">
<table class="minha-tabela">
<thead>
    <div class="">
    <tr> 
        <th scope = "col">Nome do cliente</th>
        <th scope = "col">Produtos</th>
        <th scope = "col">Valor final</th>
        <th scope = "col">Forma de pagamento</th>
        <th scope = "col">status</th>
	<th scope = "col">data</th>

     </tr>
</div>
</thead>
    <tbody>
        <?php 
            while($user_data = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
		echo"<td>".$user_data['']."</td>";


               }
        ?>
    </tbody>
</table>
</div>

<center>
<h1>Vendas Semanais </h1>
</center>

<div class ="tabelafeirante">
<table class="minha-tabela">
<thead>
    <div class="">
    <tr> 
        <th scope = "col">Nome do cliente</th>
        <th scope = "col">Produtos</th>
        <th scope = "col">Valor final</th>
        <th scope = "col">Forma de pagamento</th>
        <th scope = "col">status</th>
	<th scope = "col">data</th>

     </tr>
</div>
</thead>
    <tbody>
        <?php 
            while($user_data = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
		echo"<td>".$user_data['']."</td>";
		echo"<td>".$user_data['']."</td>";

               }
        ?>
    </tbody>
</table>
</div>
<center>
<h1>Vendas Mensais </h1>
<center>

<div class ="tabelafeirante">
<table class="minha-tabela">
<thead>
    <div class="">
    <tr> 
        <th scope = "col">Nome do cliente</th>
        <th scope = "col">Produtos</th>
        <th scope = "col">Valor final</th>
        <th scope = "col">Forma de pagamento</th>
        <th scope = "col">status</th>
	<th scope = "col">data</th>

     </tr>
</div>
</thead>
    <tbody>
        <?php 
            while($user_data = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
                echo"<td>".$user_data['']."</td>";
		echo"<td>".$user_data['']."</td>";
		echo"<td>".$user_data['']."</td>";

               }
        ?>
    </tbody>
</table>
</div>

</body>
</html>