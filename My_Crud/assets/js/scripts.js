// =====================
// 1. TOAST — aviso visual
// =====================
function toast(msg, tipo) {
    const div = document.createElement('div');
    div.textContent = msg;
    div.style.cssText = `
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        padding: .75rem 1.25rem;
        border-radius: 10px;
        color: #fff;
        font-weight: 500;
        font-size: 14px;
        z-index: 999;
        background: ${tipo === 'success' ? '#10b981' : '#ef4444'};
        animation: slideIn .3s ease;
    `;
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000);
}

// =====================
// 2. MODAL — confirmação antes de excluir
// =====================
function abrirModal(id, nome) {
    document.getElementById('modal-nome').textContent = nome;
    document.getElementById('btn-confirmar').href = `excluir.php?id=${id}`;
    document.getElementById('overlay').style.display = 'flex';
}

function fecharModal() {
    document.getElementById('overlay').style.display = 'none';
}

// =====================
// 3. LOADING — botão de salvar
// =====================
document.querySelector('form')?.addEventListener('submit', function(e) {
    const nome = document.querySelector('[name="nome"]')?.value.trim();
    if (!nome) {
        alert('⚠️ Informe o nome do produto!');
        e.preventDefault();
        return;
    }
    const btn = document.querySelector('button[type="submit"]');
    btn.disabled = true;
    btn.textContent = '⏳ Salvando...';
});