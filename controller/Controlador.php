<?php
require_once __DIR__ . '/ProdutoDAO.php';
require_once __DIR__ .'/../model/Produto.php';
session_start();

class Controlador {
    private $dao;

    public function __construct() {
        $this->dao = new ProdutoDAO();
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = [];
        }
    }

    public function listar() {
        $resultado = $this->dao->listar();

        $produtos = [];
        while ($row = pg_fetch_assoc($resultado)) {
            $produtos[] = new Produto(
                $row['codigo'],
                $row['descricao'],
                $row['preco'],
                $row['qtde']
            );
        }
        return $produtos;
    }
    public function buscar($codigo) { return $this->dao->buscar($codigo); }
    public function gravar($descricao, $preco, $qtde) {
        $p = new Produto(null, $descricao, $preco, $qtde);
        $this->dao->gravar($p);
    }
    public function alterar($codigo, $descricao, $preco, $qtde) {
        $p = new Produto($codigo, $descricao, $preco, $qtde);
        $this->dao->alterar($p);
    }
    public function remover($codigo) { $this->dao->remover($codigo); }

    public function adicionarAoCarrinho($codigo, $qtde) {
        $resultado = $this->dao->buscar($codigo);
        $row = pg_fetch_assoc(result: $resultado);
        if ($row && $qtde <= $row['qtde']) {
            $produto = new Produto(
                $row['codigo'],
                $row['descricao'],
                $row['preco'],
                $row['qtde']
            );
            $_SESSION['carrinho'][$codigo] = [
                'produto' => $produto,
                'qtde' => $qtde
            ];
            $this->alterar($codigo, $row['descricao'], $row['preco'], $row['qtde'] - $qtde);
            return true;
        }
        return false;
    }

    public function getCarrinho() { return $_SESSION['carrinho']; }

    public function getTotal() {
        $total = 0;
        foreach ($_SESSION['carrinho'] as $item) {
            $total += $item['produto']->getPreco() * $item['qtde'];
        }
        return $total;
    }
}