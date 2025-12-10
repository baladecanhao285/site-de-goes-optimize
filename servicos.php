<?php
require 'conexao.php';

$erros = [];
$sucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $servico = trim($_POST['servico'] ?? '');
    $detalhes = trim($_POST['detalhes'] ?? '');

    if ($nome === '') $erros[] = "Nome é obrigatório.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "Email inválido.";
    if ($servico === '') $erros[] = "Escolha um serviço.";

    if (empty($erros)) {
        $stmt = $conn->prepare("INSERT INTO pedidos_servico (nome_cliente, email_cliente, servico_escolhido, detalhes) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $servico, $detalhes);

        if ($stmt->execute()) {
            $sucesso = "Pedido enviado com sucesso!";
            $nome = $email = $servico = $detalhes = '';
        } else {
            $erros[] = "Erro ao salvar: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>
<!doctype html>
<html lang="pt-BR">

<head>
<meta charset="utf-8">
<title>Solicitar Serviço</title>

<!-- Fonte moderna -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

<style>

/* ======= BASE ======= */

body {
    margin: 0;
    padding: 40px;
    font-family: "Inter", sans-serif;
    background: #f3f4f7;
    color: #333;
}

/* Container central */
.form-wrapper {
    max-width: 520px;
    margin: auto;
    background: #fff;
    padding: 28px;
    border-radius: 18px;
    box-shadow: 0 8px 28px rgba(0,0,0,0.12);
    border: 1px solid #e5e7eb;
}

/* Título */
h2 {
    font-family: "Poppins", sans-serif;
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 18px;
    color: #222;
}

/* ======= MENSAGENS ======= */

.sucesso {
    background: #d1fae5;
    color: #065f46;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 18px;
    font-weight: 500;
}

.erros {
    background: #fee2e2;
    color: #b91c1c;
    padding: 12px;
    border-radius: 10px;
    margin-bottom: 18px;
    font-weight: 500;
}

/* ======= FORM ======= */

label {
    font-weight: 600;
    font-family: "Poppins", sans-serif;
    display: block;
    margin-bottom: 6px;
    color: #333;
}

input, textarea, select {
    width: 100%;
    padding: 12px;
    margin-bottom: 16px;
    border-radius: 10px;
    border: 1px solid #d1d5db;
    font-size: 15px;
    font-family: "Inter", sans-serif;
    transition: 0.2s;
    background: #fafafa;
}

input:focus, textarea:focus, select:focus {
    border-color: #6366f1;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.25);
    outline: none;
}

textarea {
    height: 110px;
    resize: none;
}

/* ======= BOTÃO ======= */

button {
    width: 100%;
    padding: 14px;
    background: #6366f1;
    border: none;
    border-radius: 12px;
    font-size: 17px;
    font-weight: 600;
    font-family: "Poppins", sans-serif;
    color: white;
    cursor: pointer;
    transition: .2s;
}

button:hover {
    background: #4f46e5;
    transform: translateY(-2px);
}

</style>
</head>

<body>

<div class="form-wrapper">

<h2>Solicitar Serviço</h2>

<?php if ($sucesso): ?>
    <div class="sucesso"><?= htmlspecialchars($sucesso) ?></div>
<?php endif; ?>

<?php if (!empty($erros)): ?>
    <div class="erros">
        <ul>
        <?php foreach ($erros as $e) echo '<li>' . htmlspecialchars($e) . '</li>'; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="">
    <label>Nome</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($nome ?? '') ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" required>

    <label>Serviço desejado</label>
    <select name="servico" required>
        <option value="">Selecione um serviço</option>
        <option value="Criação de site" <?= (isset($servico) && $servico=="Criação de site")?"selected":"" ?>>Criação de site</option>
        <option value="Marketing digital" <?= (isset($servico) && $servico=="Marketing digital")?"selected":"" ?>>Marketing digital</option>
        <option value="Gestão de redes sociais" <?= (isset($servico) && $servico=="Gestão de redes sociais")?"selected":"" ?>>Gestão de redes sociais</option>
        <option value="SEO" <?= (isset($servico) && $servico=="SEO")?"selected":"" ?>>SEO</option>
    </select>

    <label>Detalhes</label>
    <textarea name="detalhes"><?= htmlspecialchars($detalhes ?? '') ?></textarea>

    <button type="submit">Enviar Pedido</button>
</form>

</div>

</body>
</html>
