<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'corretores_db');

    if ($conn->connect_error) {
        die('Erro na conexão: ' . $conn->connect_error);
    }

    $name = $conn->real_escape_string($_POST['name']);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $creci = $conn->real_escape_string($_POST['creci']);

    // Verifica se já existe um registro com o mesmo CPF ou CRECI
    $sql_check = "SELECT * FROM corretores WHERE cpf = '$cpf' OR creci = '$creci'";
    $result = $conn->query($sql_check);

    if ($result && $result->num_rows > 0) {
        // Mensagem de erro
        echo "<script>
            alert('Erro: CPF ou CRECI já cadastrado.');
            window.location.href = 'index.php';
        </script>";
    } else {
        // Insere os dados no banco
        $sql_insert = "INSERT INTO corretores (name, cpf, creci) VALUES ('$name', '$cpf', '$creci')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>
                alert('Cadastro realizado com sucesso!');
                window.location.href = 'index.html';
            </script>";
        } else {
            echo "Erro ao cadastrar: " . $conn->error;
        }
    }

    $conn->close();
}
?>
