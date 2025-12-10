<?php /* Header + Menu */ ?>
<header class="header">
  <div class="container header-inner">
    <a class="brand" href="index.php" aria-label="Home">
      <span class="logo">D</span>
      <span>De Goes Optimize</span>
    </a>
    <button class="menu-button" data-open-menu aria-haspopup="dialog" aria-expanded="false" aria-controls="mainmenu">
      <span>Menu</span>
      <span class="bars" aria-hidden="true"></span>
    </button>
  </div>
</header>

<div id="mainmenu" class="overlay" role="dialog" aria-modal="true" aria-label="Menu principal">
  <div class="panel">
    <nav>
      <ul>
        <li><a href="projects.php">Projetos</a></li>
        <li><a href="about.php">Sobre</a></li>
        <li><a href="index.php#newsletter">Fale Conosco</a></li>
        <li><a href="contact.php">Contato</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="consultar.php">CRUD</a></li>
        <li><a href="servicos.php">Pedir Serviço</a></li>
        <li><a href="admin_servicos.php">Pedidos (Admin)</a></li>
      </ul>
    </nav>
    <div class="social">
      <a class="underline" href="https://instagram.com/degoesoptimize" target="_blank" rel="noopener">Instagram</a>
      <a class="underline" href="#" target="_blank" rel="noopener">Behance</a>
      <a class="underline" href="#" target="_blank" rel="noopener">Dribbble</a>
      <a class="underline" href="#" target="_blank" rel="noopener">LinkedIn</a>
    </div>
    <p class="muted" style="margin-top:24px">
      <a data-close-menu class="underline" href="#">Fechar</a>
    </p>
  </div>
</div>

<!-- Botão de alternância de tema - canto superior esquerdo -->
<button id="theme-toggle" class="theme-toggle" aria-label="Alternar tema">
  ☀️
</button>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const body = document.body;
  const themeToggle = document.getElementById('theme-toggle');

  function setTheme(theme) {
    if (!themeToggle) return;

    if (theme === 'light') {
      body.classList.add('light');
      themeToggle.textContent = '🌙'; // mostra lua: clicar volta pro dark
    } else {
      body.classList.remove('light');
      themeToggle.textContent = '☀️'; // mostra sol: clicar vai pro claro
    }
  }

  // Lê tema salvo
  const storedTheme = localStorage.getItem('theme');
  if (storedTheme === 'light' || storedTheme === 'dark') {
    setTheme(storedTheme);
  } else {
    // Padrão: dark em todo o site
    setTheme('dark');
  }

  if (themeToggle) {
    themeToggle.addEventListener('click', () => {
      const isLight = body.classList.contains('light');
      const next = isLight ? 'dark' : 'light';
      setTheme(next);
      localStorage.setItem('theme', next);
    });
  }
});
</script>
