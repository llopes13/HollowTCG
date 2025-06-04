document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    // Verifica o tema salvo ou preferência do sistema
    const savedTheme = localStorage.getItem('theme') ||
        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

    // Aplica o tema inicial
    body.setAttribute('data-theme', savedTheme);
    updateButtonIcon(savedTheme);

    // Alternador de tema
    themeToggle.addEventListener('click', function() {
        const currentTheme = body.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        body.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateButtonIcon(newTheme);
    });

    // Atualiza o ícone do botão
    function updateButtonIcon(theme) {
        themeToggle.textContent = theme === 'dark' ? '☀️ Tema Claro' : '🌙 Tema Escuro';
    }

    // Detecta mudanças na preferência do sistema
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        const newTheme = e.matches ? 'dark' : 'light';
        body.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateButtonIcon(newTheme);
    });
});
