
function ValidarForm(){
    const nome = document.getElementById('name').value;
    const cpf = document.getElementById('cpf').value;
    const creci = document.getElementById('creci').value;

    if (nome.length < 2) {
        alert('O nome deve ter pelo menos 2 caracteres.');
        return false;
    }
    if (cpf.length !== 11 || isNaN(cpf)) {
        alert('O CPF deve ter exatamente 11 números.');
        return false;
    }
    if (creci.length < 2) {
        alert('O Creci deve ter pelo menos 2 caracteres.');
        return false;
    }
    return true;
}
