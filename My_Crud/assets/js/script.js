function toast(msg, tipo = 'success') {
    const wrap = document.getElementById('toastWrap');
    const div = document.createElement('div');
    div.className = `toast toast-${tipo}`;
    div.textContent = msg;
    wrap.appendChild(div);
    setTimeout(() => div.classList.add('show'), 10);
    setTimeout(() => {
        div.classList.replace('show', 'hide');
        setTimeout(() => div.remove(), 400);
    }, 3000);
}

// 2. MODAL — confirmação antes de excluir
function abrirModal(id, nome) {
    document.getElementById('modal-nome').textContent = nome;
    document.getElementById('btn-confirmar').href = `excluir.php?id=${id}`;
    document.getElementById('overlay').classList.add('show');
}
function fecharModal() {
    document.getElementById('overlay').classList.remove('show');
}

// 3. LOADING — botão de salvar
document.querySelector('form')?.addEventListener('submit', function(e) {
    const nome = document.querySelector('[name="nome"]')?.value.trim();
    if (!nome) {
        alert('⚠️ Informe o nome!');
        e.preventDefault();
        return;
    }
    const btn = document.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.innerHTML = '⏳ Salvando...';
});