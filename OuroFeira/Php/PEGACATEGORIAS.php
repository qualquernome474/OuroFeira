


<?php

include('CONEXAO.php');
echo("11dfs");





echo("3");






$sql = "SELECT * FROM categorias";
$result=$conn->query($sql);


if ($result->num_rows > 0) {
    // Loop through the results and populate the select box options
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
    }
} else {
    echo "<option>No categories found</option>";
}

$conn->close();
?>