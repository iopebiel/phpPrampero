<?php
require_once(__DIR__ . '/controller/Controlador.php');
$ctrl = new Controlador();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ok = $ctrl->adicionarAoCarrinho($_POST['codigo'], $_POST['qtde']);
    if (!$ok) {
        $mensagem = "<p style='color:red'>Quantidade inválida!</p>";
    }
}

$produtos = $ctrl->listar();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>Loja - Primeiro Site PHP</title>
</head>
<body>
    <h2>Loja</h2>

    <?php if (!empty($mensagem)) echo $mensagem; ?>

    <table border="1" cellpadding="5">
        <tr>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Estoque</th>
            <th>Comprar</th>
        </tr>
        <?php if (!empty($produtos)): 
                foreach ($produtos as $p): ?>
                <tr>
                    <td><?php echo $p->getDescricao(); ?></td>
                    <td>R$ <?php echo number_format($p->getPreco(), 2, ',', '.'); ?></td>
                    <td><?php echo $p->getQtde(); ?></td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="codigo" value=<?php echo $p->getCodigo();?>>
                            <input type="number" name="qtde" value="1" min="1" max=<?php echo $p->getQtde();?> required>
                            <button type="submit">Adicionar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Nenhum produto cadastrado.</td></tr>
        <?php endif; ?>
    </table>

    <p>
        <a href="./view/Carrinho.php">Ver Carrinho</a> | 
        <a href="./view/CrudProduto.php">Gerenciar Produtos</a>
    </p>
</body>
</html>
