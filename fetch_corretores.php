<tbody>
    <?php
    // Conexão ao banco de dados
    $conn = new mysqli('localhost', 'root', '', 'corretores_db');

    if ($conn->connect_error) {
        die('<tr><td colspan="5">Erro na conexão: ' . htmlspecialchars($conn->connect_error) . '</td></tr>');
    }

    // Busca os dados
    $sql = "SELECT * FROM corretores";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
            echo "<td>" . htmlspecialchars($row['creci']) . "</td>";
            echo "<td>
                   <button onclick=\"carregarEditar(" . $row['id'] . ",'" . htmlspecialchars($row['name']) . "','" . htmlspecialchars($row['cpf']) . "','" . htmlspecialchars($row['creci']) . "')\">Editar</button>
                <form method='POST' action='delete.php' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button type='submit' onclick=\"return confirm('Tem certeza que deseja excluir este registro?')\">Excluir</button>
                </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>Nenhum corretor encontrado.</td></tr>";
    }

    $conn->close();
    ?>
</tbody>
