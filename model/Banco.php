<?php
class Banco
{
    public $conexao;

    //construtor
    function __construct()
    {
        // definições de host, database, usuário e senha
        $host = "localhost";
        $base   = "tocc8"; //alterado para minusculo
        $porta = "5432";
        $user = "postgres";
        $senha = "ifsp";
        /// conecta ao banco de dados
        $str_conexao = "host=$host port=$porta dbname=$base user=$user password=$senha";
        $this->conexao = pg_connect($str_conexao);

        if (!$this->conexao) {
            die("Conexão falhou: " . pg_last_error());
        }
    }
}
