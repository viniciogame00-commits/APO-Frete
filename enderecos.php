<?php
include "includes/conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $rua = $_POST["rua"];
    $cidade = $_POST["cidade"];
    $cep = $_POST["cep"];
    $telefone = $_POST["telefone"];

    $sql = "INSERT INTO enderecos (nome, rua, cidade, cep, telefone) VALUES (?, ?, ?, ?, ?)";
    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "sssss", $nome, $rua, $cidade, $cep, $telefone);
    mysqli_stmt_execute($comando);

    $mensagem = "Endereço cadastrado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Enderecos </title>
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
    <h2>Cadastro de Endereços</h2>

    <?php if (isset($mensagem)) { ?>
    <div class="alert alert-success"><?php echo $mensagem; ?></div>
    <?php } ?>

    <form action="enderecos.php" method="post">

        <div class="mb-3">
            <label class="form-label">Nome do Local</label>
            <input type="text" name="nome" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Rua e número</label>
            <input type="text" name="rua" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Cidade e Estado</label>
            <input type="text" name="cidade" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">CEP</label>
            <input type="text" name="cep" class="form-control">
        </div>
         <div class="mb-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control">
        </div>
            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Salvar</button>
    </form>

</div>

</body>
</html>