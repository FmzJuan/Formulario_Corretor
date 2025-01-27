<?php
$conn = new mysqli('localhost', 'root', '', 'corretores_db');

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = $conn->real_escape_string($_POST['name']);
    $cpf = $conn->real_escape_string($_POST['cpf']);
    $creci = $conn->real_escape_string($_POST['creci']);

    // Validações de CPF e CRECI
    if (strlen($cpf) !== 11 || !ctype_digit($cpf)) {
        header("Location: index.php?error=CPF inválido. Deve conter 11 dígitos.");
        exit;
    }

    if (strlen($creci) < 2 || !ctype_digit($creci)) {
        header("Location: index.php?error=CRECI inválido.");
        exit;
    }

    // Verifica duplicidade de CPF ou CRECI
    $sql_check = "SELECT * FROM corretores WHERE (cpf = '$cpf' OR creci = '$creci')";
    if ($id > 0) {
        $sql_check .= " AND id != $id"; // Ignora o registro atual ao editar
    }

    $result = $conn->query($sql_check);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['cpf'] === $cpf) {
            header("Location: index.php?error=CPF já cadastrado.");
            exit;
        }
        if ($row['creci'] === $creci) {
            header("Location: index.php?error=CRECI já cadastrado.");
            exit;
        }
    }

    if ($id > 0) {
        // Atualizar
        $sql = "UPDATE corretores SET name='$name', cpf='$cpf', creci='$creci' WHERE id=$id";
        $message = "Registro atualizado com sucesso!";
    } else {
        // Inserir
        $sql = "INSERT INTO corretores (name, cpf, creci) VALUES ('$name', '$cpf', '$creci')";
        $message = "Registro cadastrado com sucesso!";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?message=$message");
    } else {
        header("Location: index.php?error=Erro ao salvar registro.");
    }

    exit;
}

$conn->close();
?>

