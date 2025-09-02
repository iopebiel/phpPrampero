<?php
require_once __DIR__ . '/../controller/Controlador.php';
$ctrl = new Controlador();

if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'inserir':
            $ctrl->gravar($_POST['descricao'], $_POST['preco'], $_POST['qtde']);
            break;
        case 'editar':
            $ctrl->alterar($_POST['codigo'], $_POST['descricao'], $_POST['preco'], $_POST['qtde']);
            break;
    }
} elseif (isset($_GET['del'])) {
    $ctrl->remover($_GET['del']);
}

$produtos = $ctrl->listar();
?>
<h2>Gerenciar Produtos</h2>
<form method="post">
    <input type="hidden" name="acao" value="inserir">
    Descrição: <input type="text" name="descricao" required>
    Preço: <input type="number" name="preco" step="0.01" min="0" placeholder="R$ 0,00" required>
    Estoque: <input type="number" name="qtde"value="1" min="1" step="1" required>
    <button type="submit">Adicionar</button>
</form>

<hr>
<table border="1" cellpadding="5">
<tr><th>Código</th><th>Descrição</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr>
<?php foreach ($produtos as $p): ?>
<tr>
    <form method="post">
        <td><?= $p->getCodigo() ?></td>
        <td><input type="text" name="descricao" value="<?= $p->getDescricao() ?>"></td>
        <td><input type="number" name="preco" step="0.01" min="0" value="<?= $p->getPreco() ?>"></td>
        <td><input type="number" name="qtde" min="1" step="1"   value="<?= $p->getQtde() ?>"></td>
        <td>
            <input type="hidden" name="codigo" value="<?= $p->getCodigo() ?>">
            <input type="hidden" name="acao" value="editar">
            <button type="submit">Salvar</button>
            <a href="?del=<?= $p->getCodigo() ?>" onclick="return confirm('Excluir?')">Excluir</a>
        </td>
    </form>
</tr>
<?php endforeach; ?>
</table>
<a href="../index.php">Ir para Loja</a>
