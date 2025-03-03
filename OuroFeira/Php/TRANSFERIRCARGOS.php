<?php
include('CONEXAO.php');
$cpf = $_POST['cpf'];
$Tconta = $_POST['Tconta'];



// Consultar o usu�rio
$sql = "SELECT * FROM usuario WHERE cpf = '$cpf'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $cargo = $row['cargo'];

    // L�gica de altera��o do cargo
    if ($cargo == "feirante" && $Tconta != "feirante") {
        // Se o cargo for feirante e Tconta n�o for feirante, mudar para comum
        $sql = "UPDATE usuario SET cargo = 'comum' WHERE cpf = '$cpf'";
        $result = $conn->query($sql);

        // Deletar barraca
        $sql = "DELETE FROM barracas WHERE responsavel = '$cpf'";
        $result = $conn->query($sql);
    } elseif ($cargo != "feirante" && $Tconta == "feirante") {
        // Se o cargo n�o for feirante e Tconta for feirante, exibir o alert
        echo "<script>
                alert('Use a tela de cadastrar feirantes!');
                window.location.href = '../html/transferircargos.html';
              </script>";
        exit; // Garantir que o c�digo pare aqui para evitar duplica��o de redirecionamento
    } elseif ($cargo != "feirante" && $Tconta != "feirante") {
        // Se o cargo n�o for feirante e Tconta tamb�m n�o for feirante, atualizar o cargo normalmente
        $sql = "UPDATE usuario SET cargo = '$Tconta' WHERE cpf = '$cpf'";
        $result = $conn->query($sql);
    }
} else {
    echo "Usu�rio n�o encontrado!";
}

$conn->close();

// Caso n�o tenha havido necessidade de confirmar, redireciona normalmente
header("Location: ../html/transferircargos.html");
exit;
?>
