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
    <script src="../javascript/script.js"></script>

    <title>Tela Inicial</title>
</head>
<body>
<center>
	 	      <h1>Ouro feira</h1>
       

        <div class="logocanto">
            <a href="../html/telaFeirante.html">
            <img  src="../Imagems/logo.png" alt="" height="125" width="">
        </a>
        </div>
    
</center>
   <section> 
    <div class="quadradocadPDR">

        <div class="StylecadrastoPdr">
            <h1>Cadrasto de Produtos</h1>
        </div>

        

        
        <form action="../Php/CADRASTOPROD.php" enctype="multipart/form-data" method="POST">
            <div class="form-groupCADpdr">
                <label for="">Nome:</label>
                <input type="text" id="nome" name="nome"><br>
            </div>

            <div class="form-groupCADpdr">
                <label for="">Preço:</label>
                <input type="text" id="preco" name="preco"><br>
            </div>

            <div class="form-groupCADpdr">
                <label for="">Peso:</label>
                <input type="text" id="peso" name="peso"><br>
            </div>


                <div class="form-groupCADpdr">
    <label for="CategoriasProdutos">Categoria:</label>
    <select id="CategoriasProdutos" name="CategoriasProdutos">
        
        <?php echo $options;?>
    </select>
    <br>
</div>

                <div class="form-groupCADpdr">
                    <label for="">Validade: </label>
                    <input type="date" name="validade" id="validade"><br>
                </div>
        
                <div class="form-groupCADpdr">
                    <label for="">Quantidade:</label>
                    <input type="text" id="quantidade" name="quantidade"><br>
                </div>

                <div class="form-groupCADpdr">
                    <label for="">Descrição:</label>
                    <input type="text" id="descricao" name="descricao"><br>
                </div>

                <div class="form-groupCADpdr">
                    <label for="">Selecionar foto</label>
                     <input name="arquivos" type="file">
                 </div>
                     
            <br>
            
            <div class="centerbtnCADpdr">

                <button type="submit">Cadrastrar Produto</button>
            </div>
         </form>
</section>
    
       

        
        
    </body>
</html>