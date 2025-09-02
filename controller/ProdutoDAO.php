<?php
include(__DIR__ . '/../model/Banco.php');
include(__DIR__ . '/../model/Produto.php');

class ProdutoDAO
{
    public function gravar($obj)
    {
        $banco = new Banco();
        $resultado = pg_query($banco->conexao, "Insert into produto(descricao,preco,qtde) values('" . $obj->getDescricao() . "'," . $obj->getPreco() . "," . $obj->getQtde() . ")");
        $r = pg_affected_rows($resultado);
        pg_close($banco->conexao);
        return $r;
    }

    public function listar()
    {
        $banco = new Banco();
        $tabela = pg_query($banco->conexao, "Select * from produto order by 2 desc;");
        pg_close($banco->conexao);
        return $tabela;
    }
    public function buscar($codigo) {
        $banco = new Banco();
        $linha = pg_query($banco->conexao, "Select * from produto WHERE codigo=$codigo");
        pg_close($banco->conexao);
        if ($linha) {
            return $linha;
        }
        return null;
    }
    public function remover($codigo)
    {
        $banco = new Banco();
        $resultado = pg_query($banco->conexao, "Delete from produto where codigo = " . $codigo);
        $r = pg_affected_rows($resultado);
        pg_close($banco->conexao);
        return $r;
    }
    public function alterar($obj)
    {
        $banco = new Banco();
        $resultado = pg_query($banco->conexao, "Update produto set descricao='" . $obj->getDescricao() . "', preco = " . $obj->getPreco() . ", qtde = " . $obj->getQtde() . " where codigo = " . $obj->getCodigo());
        $r = pg_affected_rows($resultado);
        pg_close($banco->conexao);
        return $r;
    }
}
