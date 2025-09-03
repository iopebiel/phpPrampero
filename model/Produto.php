<?php
class Produto {
    private $codigo;
    private $descricao;
    private $preco;
    private $qtde;

    public function __construct($c, $d, $p, $q = null) {
        $this->codigo = $c;
        $this->descricao = $d;
        $this->preco = $p;
        $this->qtde = $q;
    }

    public function setCodigo($c){
        $this->codigo=$c;
    }
    public function getCodigo(){
        return $this->codigo;
    }
    public function setDescricao($d){
        $this->descricao=$d;
    }
    public function getDescricao(){
        return $this->descricao;
    }
    public function setPreco($p){
        $this->preco=$p;
    }
    public function getPreco(){
        return $this->preco;
    }
    public function setQtde($q){
        $this->qtde=$q;//settype($q,"integer");
    }
    public function getQtde(){
        return $this->qtde;
    }
}
?>
