<?php
include "includes/conexao.php";

$endereco = ["codigo" => "", "nome" => "", "rua" => "", "cidade" => "", "cep" => "", "telefone" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $rua = $_POST["rua"];
    $cidade = $_POST["cidade"];
    $cep = $_POST["cep"];
    $telefone = $_POST["telefone"];

    if ($codigo == "") {
        $sql = "INSERT INTO enderecos (nome, rua, cidade, cep, telefone) VALUES (?, ?, ?, ?, ?)";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "sssss", $nome, $rua, $cidade, $cep, $telefone);
        $mensagem = "Endereço cadastrado com sucesso!";
    } else {
        $sql = "UPDATE enderecos SET nome = ?, rua = ?, cidade = ?, cep = ?, telefone = ? WHERE codigo = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "sssssi", $nome, $rua, $cidade, $cep, $telefone, $codigo);
        $mensagem = "Endereço atualizado com sucesso!";
    }
    mysqli_stmt_execute($comando);
} elseif (isset($_GET["codigo"])) {
    $comando = mysqli_prepare($conexao, "SELECT * FROM enderecos WHERE codigo = ?");
    mysqli_stmt_bind_param($comando, "i", $_GET["codigo"]);
    mysqli_stmt_execute($comando);
    $endereco = mysqli_fetch_assoc(mysqli_stmt_get_result($comando));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Endereços</title>
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
            <input type="hidden" name="codigo" value="<?php echo $endereco["codigo"]; ?>">

            <div class="mb-3">
                <label class="form-label">Nome do Local</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $endereco["nome"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rua e número</label>
                <input type="text" name="rua" class="form-control" value="<?php echo $endereco["rua"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Cidade e Estado</label>
                <input type="text" name="cidade" class="form-control" value="<?php echo $endereco["cidade"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" value="<?php echo $endereco["cep"]; ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control" value="<?php echo $endereco["telefone"]; ?>" required>
            </div>

            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Salvar</button>
        </form>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Rua</th>
                    <th>Cidade</th>
                    <th>CEP</th>
                    <th>Telefone</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultado = mysqli_query($conexao, "SELECT * FROM enderecos");
                while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                    <tr>
                        <td><?php echo $linha["nome"]; ?></td>
                        <td><?php echo $linha["rua"]; ?></td>
                        <td><?php echo $linha["cidade"]; ?></td>
                        <td><?php echo $linha["cep"]; ?></td>
                        <td><?php echo $linha["telefone"]; ?></td>
                        <td><a href="enderecos.php?codigo=<?php echo $linha["codigo"]; ?>">Editar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>