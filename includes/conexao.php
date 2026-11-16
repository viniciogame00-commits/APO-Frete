<?php
$conexao = mysqli_connect("localhost", "root", "", "apo_fretes");

if (!$conexao) {
    die("Erro ao conectar com o banco: " . mysqli_connect_error());
}
?>