<?php
include "includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $cpf_cnpj = $_POST["cpf_cnpj"];
    $telefone = $_POST["telefone"];
    $cidade = $_POST["cidade"];

    $sql = "INSERT INTO transportadores (nome, cpf_cnpj, telefone, cidade) VALUES (?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "ssss", $nome, $cpf_cnpj, $telefone, $cidade);
    mysqli_stmt_execute($comando);

    $mensagem = "Transportador cadastrado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Transportador </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand navbar-dark px-4" style="background-color: #6155F5;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" href="produtos.php">Produtos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="transportadores.php">Transportadoras</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="enderecos.php">Endereços</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="fretes.php">Fretes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="relatorio.php">Relatório</a>
            </li>
        </ul>
    </nav>
    <div class="container mt-4" style="max-width: 500px; margin-left: 40px;">
        <h2>Cadastro de Transportador</h2>

        <?php if (isset($mensagem)) { ?>
        <div class="alert alert-success"><?php echo $mensagem; ?></div>
        <?php } ?>


        <form action="transportadores.php" method="post">


            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" name="cidade" class="form-control">
            </div>
            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Salvar</button>
        </form>

    </div>

</body>

</html>