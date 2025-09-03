<?php
require_once __DIR__ . '/../controller/Controlador.php';
require_once  __DIR__ . '/../model/Produto.php';
$ctrl = new Controlador();
$carrinho = $ctrl->getCarrinho();
?>


<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <title>Loja - Primeiro Site PHP</title>
    </head>
    <body>
        <h2>Carrinho de Compras</h2>
        <?php if (empty($carrinho)): ?>
            <p>Carrinho vazio</p>
        <?php else: ?>
            <table border="1" cellpadding="5">
                <tr><th>Descrição</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th></tr>
                <?php foreach ($carrinho as $item): 
                $p = $item['produto'];
                $sub = $p->getPreco() * $item['qtde'];
                ?>
                    <tr>
                        <td><?= $p->getDescricao() ?></td>
                        <td>R$ <?= number_format($p->getPreco(),2,',','.') ?></td>
                        <td><?= $item['qtde'] ?></td>
                        <td>R$ <?= number_format($sub,2,',','.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><b>Total</b></td>
                    <td><b>R$ <?= number_format($ctrl->getTotal(),2,',','.') ?></b></td>
                </tr>
            </table>
        <?php endif; ?>
        <a href="../index.php">Voltar</a>
    </body>
</html>
