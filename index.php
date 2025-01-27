<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    
    <script src="code.js"></script>
   
    <title>corretor</title>
   
</head>
<body>
    
    <h1 id="form-title">Cadastro de Corretor</h1>
    
    <form action="save.php" method="POST" onsubmit="return ValidarForm()">
        <input type="hidden" name="id" id="id">
       <div>
        <input type="number" name="cpf" id="cpf" pattern="\\d{11}" placeholder="Digite o seu CPF" required>
        <input type="number" name="creci" pattern="\\d{11}" id="creci" placeholder="Digite o seu creci" required>  
    </div>
        <input type="text" name="name" id="name" placeholder="Digite o seu nome" required>
      
        <button type="submit" id="enviar">Enviar</button>
        <button type="button" id="cancel-button" style="display: none;" onclick="resetForm()">Cancelar</button>
    
    </form>
    <h2>Lista de Corretores</h2>
    <table>
        <thead>
            <tr>
                <th>ID:</th>
                <th>NOME:</th>
                <th>CPF:</th>
                <th>CRECI:</th>
                <th>AÇÕES:</th>
            </tr>
        </thead>
        <tbody>
            <?php include 'fetch_corretores.php'; ?>
                <?php if (isset($_GET['message'])): ?>
                <div style="color: green; text-align: center;"><?php echo htmlspecialchars($_GET['message']); ?></div>
            <?php elseif (isset($_GET['error'])): ?>
                <div style="color: red; text-align: center;"><?php echo htmlspecialchars($_GET['error']); ?></div>
            <?php endif; ?>

         </tbody>
    </table>
<script>
    function carregarEditar(id, name, cpf, creci) {
    document.getElementById('id').value = id;
    document.getElementById('name').value = name;
    document.getElementById('cpf').value = cpf;
    document.getElementById('creci').value = creci;
    document.getElementById('enviar').innerText = 'Salvar';
    document.getElementById('form-title').innerText = 'Editar Corretor';
    document.getElementById('cancel-button').style.display = 'inline-block';
}
function resetForm() {
    // Limpar os campos do formulário
    document.getElementById('id').value = '';
    document.getElementById('name').value = '';
    document.getElementById('cpf').value = '';
    document.getElementById('creci').value = '';

    // Alterar o botão para "Enviar"
    document.getElementById('enviar').innerText = 'Enviar';

    // Alterar o título para "Cadastro de Corretor"
    document.getElementById('form-title').innerText = 'Cadastro de Corretor';
    document.getElementById('cancel-button').style.display = 'none';
}


</script>
</body>
</html>