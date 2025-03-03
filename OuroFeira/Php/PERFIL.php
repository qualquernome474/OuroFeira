<?php 
session_start();


include('CONEXAO.php');

$cpf=$_SESSION["cpf"];







$sql = "SELECT * FROM usuario WHERE cpf = '$cpf'";

$result = $conn->query($sql);
$row = $result->fetch_assoc()

?>







<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>

    <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>
    
</head>
<body onload="funcADM()">
    
        
           <center> <h1 style="color: #FD914D;">Ouro feira</h1></center>
        
    
        
            <div class="logotam">
            <div class="logocanto ">
                <a href="../Php/TELAACESSOCOMPRAS.php">
                    <img src="../Imagems/logo.png" alt="" height="125" width="">
                </a>
            </div>
        

        <div class="btnCanto2">
	    <button onclick="window.location.href='../Php/MOSTRAHISTORICO.php';">Hist�rico de compras</button>
        </div>

        
        
        <div class="quadradoperfil">
            <div class="centPerfilclientes">

		


        <form action="../Php/ATUALIZAPERFIL.php" enctype="multipart/form-data" method="POST">   
                <div class="user-icon">
                    
                <img src="<?php echo htmlspecialchars($row['imagemperfil'], ENT_QUOTES, 'UTF-8'); ?>" alt="Card Image" class="card-img">

                    
                  </div>
                </div>
            <div class="form-group"> 
                <label for="inputField">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>">
    
                <label for="inputField">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">
    
                <label for="inputField">Telefone:</label>
                <input type="text" id="telefone" name="telefone" value="<?php echo htmlspecialchars($row['telefone']); ?>">
    
                <label for="inputField">Endereço:</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($row['endereco']); ?>">
    
                <label for="inputField">Cpf:</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($row['cpf']); ?>" readonly>
    
             
                
                
                <label for="">Trocar foto</label>
                <input name="arquivos" type="file">


            </div>
                <div class="centerbtn5">
		            <button type="submit">Salvar</button>
                                    </div>

        </form>

<div class="centerbtn5">
<form action="../Php/CARRINHO.php" method="POST">

		<button type="submit" name="logout">Sair</button>

	
		</form>     
        </div> 
    </div>
 </div>
       
</body>
</html>