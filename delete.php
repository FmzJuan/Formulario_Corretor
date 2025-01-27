<?php
$conn = new mysqli('localhost', 'root', '', 'corretores_db');

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "DELETE FROM corretores WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?message=Registro excluído com sucesso!");
    } else {
        header("Location: index.php?error=Erro ao excluir registro.");
    }
    exit;
}

$conn->close();
?>
