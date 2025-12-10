<?php
require 'conexao.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: admin_servicos.php'); exit; }

// pegar dados atuais
$stmt = $conn->prepare("SELECT * FROM pedidos_servico WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$pedido = $res->fetch_assoc();
$stmt->close();

if (!$pedido) { header('Location: admin_servicos.php'); exit; }

$erros = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servico = trim($_POST['servico'] ?? '');
    $detalhes = trim($_POST['detalhes'] ?? '');

    if ($servico === '') $erros[] = "Escolha um serviço.";

    if (empty($erros)) {
        $upd = $conn->prepare("UPDATE pedidos_servico SET servico_escolhido = ?, detalhes = ? WHERE id = ?");
        $upd->bind_param("ssi", $servico, $detalhes, $id);
        if ($upd->execute()) {
            header('Location: admin_servicos.php');
            exit;
        } else {
            $erros[] = "Erro ao atualizar: " . $upd->error;
        }
        $upd->close();
    }
}
?>
<!doctype html>
<html lang="pt-BR">
<head><meta charset="utf-8"><title>Editar Pedido</title></head>
<body>
<h2>Editar Pedido #<?= $pedido['id'] ?></h2>

<?php if (!empty($erros)): ?>
    <div style="color:red"><ul><?php foreach($erros as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul></div>
<?php endif; ?>

<form method="post">
    <p><strong>Nome:</strong> <?= htmlspecialchars($pedido['nome_cliente']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($pedido['email_cliente']) ?></p>

    <label>Serviço:<br>
        <select name="servico" required>
            <option value="">-- escolha --</option>
            <?php
            $opcoes = ["Criação de site","Marketing digital","Gestão de redes sociais","SEO"];
            foreach ($opcoes as $o) {
                $sel = ($pedido['servico_escolhido'] == $o) ? 'selected' : '';
                echo "<option value=\"".htmlspecialchars($o)."\" $sel>".htmlspecialchars($o)."</option>";
            }
            ?>
        </select>
    </label><br><br>

    <label>Detalhes:<br>
        <textarea name="detalhes"><?= htmlspecialchars($pedido['detalhes']) ?></textarea>
    </label><br><br>

    <button type="submit">Atualizar</button>
</form>
<p><a href="admin_servicos.php">Voltar</a></p>
</body>
</html>
