<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === '1234') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        // inicializa carrinho se não existir
        if (!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
        header('Location: index.php');
        exit;
    } else {
        $error = 'Usuário ou senha incorretos.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>
<div class="login-container">
    <form method="POST" action="login.php" class="login-form">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error-message"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required autofocus />
        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required />
        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>
