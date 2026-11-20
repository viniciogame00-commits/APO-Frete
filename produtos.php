<?php
include "includes/conexao.php";

$produto = ["codigo" => "", "nome" => "", "peso" => "", "medidas" => "", "quantidade" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $peso = $_POST["peso"];
    $medidas = $_POST["medidas"];
    $quantidade = $_POST["quantidade"];

    if ($codigo == "") {
        $sql = "INSERT INTO produtos (nome, peso, medidas, quantidade) VALUES (?, ?, ?, ?)";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "sdsi", $nome, $peso, $medidas, $quantidade);
        $mensagem = "Produto cadastrado com sucesso!";
    } else {
        $sql = "UPDATE produtos SET nome = ?, peso = ?, medidas = ?, quantidade = ? WHERE codigo = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "sdsii", $nome, $peso, $medidas, $quantidade, $codigo);
        $mensagem = "Produto atualizado com sucesso!";
    }
    mysqli_stmt_execute($comando);
    } elseif (isset($_GET["codigo"])) {
        $comando = mysqli_prepare($conexao, "SELECT * FROM produtos WHERE codigo = ?");
        mysqli_stmt_bind_param($comando, "i", $_GET["codigo"]);
        mysqli_stmt_execute($comando);
        $produto = mysqli_fetch_assoc(mysqli_stmt_get_result($comando));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
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
        <h2>Cadastro de Produto</h2>

        <?php if (isset($mensagem)) { ?>
        <div class="alert alert-success"><?php echo $mensagem; ?></div>
        <?php } ?>

        <form action="produtos.php" method="post">
            <input type="hidden" name="codigo" value="<?php echo $produto["codigo"]; ?>">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $produto["nome"]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Peso</label>
                <input type="number" step="0.01" name="peso" class="form-control"
                    value="<?php echo $produto["peso"]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Medidas</label>
                <input type="text" name="medidas" class="form-control" value="<?php echo $produto["medidas"]; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">Quantidade</label>
                <input type="number" name="quantidade" class="form-control"
                    value="<?php echo $produto["quantidade"]; ?>" required>
            </div>
            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Salvar</button>
        </form>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Peso</th>
                    <th>Medidas</th>
                    <th>Quantidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
        $resultado = mysqli_query($conexao, "SELECT * FROM produtos");
        while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $linha["nome"]; ?></td>
                    <td><?php echo $linha["peso"]; ?></td>
                    <td><?php echo $linha["mididas"]; ?></td>
                    <td><?php echo $linha["quantidade"]; ?></td>
                    <td><a href="produtos.php?codigo=<?php echo $linha["codigo"]; ?>">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>