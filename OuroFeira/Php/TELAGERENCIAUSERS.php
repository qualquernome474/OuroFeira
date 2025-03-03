<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

   
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet"
                    

        <link rel="stylesheet" href="../css/Style.css">
    <script src="../javascript/script.js"></script>












    <script text="text/javascript">
        $(document).ready(function() { //executa assim que carrega a p�gina
            //define as vari�veis com a p�gina atua
            var pagina = 1; // define a p�gina atual
            var qtd_result_pg = 10; //define a quantidade de p�ginas por p�gina

            listar_registros(pagina, qtd_result_pg); //chama a fun��o listar_registros

            //chama a fun��o assim que carrega a p�gina
            $("#form-pesquisa").submit(function(evento) {
                evento.preventDefault();
                listar_registros(pagina, qtd_result_pg); //chama a fun��o listar_registros
            });
        });

        //define a fun��o listar_registross()
        function listar_registros(pagina, qtd_result_pg) {
            var pesquisa = $("#pesquisa").val();
            var dados = { //define o objeto com os dados a serem enviados
                pesquisa: pesquisa,
                pagina: pagina,
                qtd_result_pg: qtd_result_pg
            }

            $.post('../Php/BUSCAUSERS.php', dados, function(retorna) { //envia os dados via post
                $(".resultados").html(retorna); //define onde o resultado ser� exibido
            });
        }

        function confirmarExclusao(id, nm) {
            if (window.confirm("Deseja realmente apagar o registro:\n" + id)) {

                window.location = "../Php/DELETABARRACA.php?cpf=" + id;
            }
        }
        </script>



</head>
<body>

        <center><h1 style="color: #FD914D;">Ouro feira</h1></center>
        

        <div class="logocanto">
            <a href="../html/telaADMIN.html">
                <img src="../Imagems/logo.png" alt="" height="125" width="">
            </a>
        </div>
    
   

    <center>
        <h2 class="text-center">USU�RIOS CADASTRADOS</h2>
    </center>
        <hr>
        <form id="form-pesquisa" action="" method="post">
            
            <div class="centarlizaPesqiusa">
                <div class="search-container">
                        <input style="background-color:#494949 ;color:  #FD914D;" type="text" size="50" name="pesquisa" id="pesquisa" placeholder="Digite sua pesquisa..">
                        <button type="submit" name="btnEnviar" id="btnEnviar" value="Pesquisar" class="card-button">Pesquisar</button>
                </div>
            </div>
        </form>
<center>
        <div class="resultados">
            <!--Os dados da busca efetuada pelo aquivo buscarPessoa.php, ser�o exibidos aqui-->
        </div>
</center>    
</body>
</html>