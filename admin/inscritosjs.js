let currentAcaId = null;

function abrirPopup(acaId, acaNome, acaSobrenome) {
    currentAcaId = acaId; // Armazena o aca_id atual
    document.getElementById('modalTitle').innerText = "Formulario: " + acaNome + " " + acaSobrenome; // Atualiza o título do modal
    document.getElementById('modalContent').innerText = "Carregando..."; // Mensagem enquanto aguarda a resposta
    document.getElementById('myModal').style.display = "block";

    // Executa a ação imediatamente ao abrir o modal
    executarAcoes(acaId);
}

document.getElementById('close').onclick = function() {
    document.getElementById('myModal').style.display = "none";
}

function executarAcoes(acaId) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "../admin/acoesinscritos.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Atualiza o conteúdo do modal com o resultado
            document.getElementById('modalContent').innerHTML = xhr.responseText;
        }
    };
    xhr.send("aca_id=" + acaId);
}

window.onclick = function(event) {
    if (event.target == document.getElementById('myModal')) {
        document.getElementById('myModal').style.display = "none";
    }
}
function filterTable() {
    const input = document.getElementById('filterInput');
    const filter = input.value.toLowerCase();
    const table = document.querySelector('.inscricao');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) { // Começa do 1 para ignorar o cabeçalho
        const tdNomeAcampante = tr[i].getElementsByTagName('td')[1]; // Nome do acampante
        const tdSobrenomeAcampante = tr[i].getElementsByTagName('td')[2]; // Sobrenome do acampante
        const tdCpfResponsavel = tr[i].getElementsByTagName('td')[3]; // CPF do responsável
        const tdNomeResponsavel = tr[i].getElementsByTagName('td')[4]; // Nome do responsável
        const tdSobrenomeResponsavel = tr[i].getElementsByTagName('td')[5]; // Sobrenome do responsável

        if (tdNomeAcampante || tdSobrenomeAcampante || tdCpfResponsavel || tdNomeResponsavel || tdSobrenomeResponsavel) {
            const txtValueNomeAcampante = tdNomeAcampante.textContent || tdNomeAcampante.innerText;
            const txtValueSobrenomeAcampante = tdSobrenomeAcampante.textContent || tdSobrenomeAcampante.innerText;
            const txtValueCpfResponsavel = tdCpfResponsavel.textContent || tdCpfResponsavel.innerText;
            const txtValueNomeResponsavel = tdNomeResponsavel.textContent || tdNomeResponsavel.innerText;
            const txtValueSobrenomeResponsavel = tdSobrenomeResponsavel.textContent || tdSobrenomeResponsavel.innerText;

            // Verifica se o filtro corresponde a algum dos campos
            if (
                txtValueNomeAcampante.toLowerCase().indexOf(filter) > -1 ||
                txtValueSobrenomeAcampante.toLowerCase().indexOf(filter) > -1 ||
                txtValueCpfResponsavel.toLowerCase().indexOf(filter) > -1 ||
                txtValueNomeResponsavel.toLowerCase().indexOf(filter) > -1 ||
                txtValueSobrenomeResponsavel.toLowerCase().indexOf(filter) > -1
            ) {
                tr[i].style.display = ""; // Mostra a linha
            } else {
                tr[i].style.display = "none"; // Esconde a linha
            }
        }
    }
}