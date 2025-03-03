<?php

include('CONEXAO.php');




$sql = "SELECT * FROM categorias";

$result = $conn->query($sql);

$options="";
while($row=mysqli_fetch_array($result)){

    $options .= "<option value='".$row['nome']."'>".$row['nome']."</option>";


}


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Style.css">
    <script src="../script.js"></script>
    <title>Cadastro</title>
</head>

<body>
	<div class="centerOUROfeiraFEIRANTE">
                <h1 style="color: #FD914D;">Ouro feira</h1>
         </div>

        <div class="logocanto">
            <a href="../html/telaADMIN.html">
                <img src="../Imagems/logo.png" alt="" height="125" width="">
            </a>
        </div>
    </div>




    <div class="quadradocadrastarFEIRANTE">
        <div class="StyleCadrastar">
            <h1>Cadastro do feirante</h1>
        </div>
        <form action="../Php/CADASTROFEIRANTE.php" enctype="multipart/form-data" method="POST">

            <div class="form-groupCADfeirante">

                <label for="inputField">Nome do feirante:</label>
                <input type="text" id="nome" name="nome">

                <label for="inputField">Nome da Barraca:</label>
                <input type="text" id="nomeBarraca" name="nomeBarraca">

                <label for="inputField">Email:</label>
                <input type="email" id="email" name="email">

                <label for="inputField">Endere�o:</label>
                <input type="text" id="endereco" name="endereco">

                <label for="inputField">Descri��o:</label>
                <textarea id="descricao" name="descricao" rows="4" cols="50"></textarea>
   		
		<label for="inputField">Telefone:</label>
                <input type="text" id="telefone" name="telefone">
 		
                <label for="CategoriasProdutos">Categoria:</label>
                <select id="CategoriasProdutos" name="CategoriasProdutos">
                                   
		<?php echo $options;?>

 </select>



                <label for="inputField">Cpf:</label>
                <input type="text" id="cpf" name="cpf">

                <label for="inputField">Senha:</label>
                <input type="password" id="senha" name="senha"><br>

	        <label for="">foto da barraca:</label>
                <input name="arquivos1" type="file">

		<label for="">foto do perfil:</label>
                <input name="arquivos2" type="file">
		</div>

            
            <div class="centerbtnfeirante">
                <button type="submit">Cadastrar feirante</button>
            </div>
        </form>
    

</body>

</html>