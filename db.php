<?php
// Conexão com o Banco de Dados MySQL
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "patinhas";

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verifica conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Garante que acentos (ex: "Médio") sejam gravados e lidos corretamente
$conexao->set_charset("utf8mb4");