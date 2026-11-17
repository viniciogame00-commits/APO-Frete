<?php
include "includes/conexao.php";

$transportador = ["codigo" => "", "nome" => "", "cpf_cnpj" => "", "telefone" => "", "cidade" => ""];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $cpf_cnpj = $_POST["cpf_cnpj"];
    $telefone = $_POST["telefone"];
    $cidade = $_POST["cidade"];

    if ($codigo == "") {
        $sql = "INSERT INTO transportadores (nome, cpf_cnpj, telefone, cidade) VALUES (?, ?, ?, ?)";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "ssss", $nome, $cpf_cnpj, $telefone, $cidade);
        $mensagem = "Transportador cadastrado com sucesso!";
    } else {
        $sql = "UPDATE transportadores SET nome = ?, cpf_cnpj = ?, telefone = ?, cidade = ? WHERE codigo = ?";
        $comando = mysqli_prepare($conexao, $sql);
        mysqli_stmt_bind_param($comando, "ssssi", $nome, $cpf_cnpj, $telefone, $cidade, $codigo);
        $mensagem = "Transportador atualizado com sucesso!";
    }
    mysqli_stmt_execute($comando);
    } elseif (isset($_GET["codigo"])) {
        $comando = mysqli_prepare($conexao, "SELECT * FROM transportadores WHERE codigo = ?");
        mysqli_stmt_bind_param($comando, "i", $_GET["codigo"]);
        mysqli_stmt_execute($comando);
        $transportador = mysqli_fetch_assoc(mysqli_stmt_get_result($comando));
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Transportador</title>
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
            <input type="hidden" name="codigo" value="<?php echo $transportador["codigo"]; ?>">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="<?php echo $transportador["nome"]; ?>"
                    required>
            </div>
            <div class="mb-3">
                <label class="form-label">CPF/CNPJ</label>
                <input type="text" name="cpf_cnpj" class="form-control"
                    value="<?php echo $transportador["cpf_cnpj"]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" name="telefone" class="form-control"
                    value="<?php echo $transportador["telefone"]; ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" name="cidade" class="form-control" value="<?php echo $transportador["cidade"]; ?>"
                    required>
            </div>
            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Salvar</button>
        </form>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Telefone</th>
                    <th>Cidade</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
$resultado = mysqli_query($conexao, "SELECT * FROM transportadores");
while ($linha = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo $linha["nome"]; ?></td>
                    <td><?php echo $linha["cpf_cnpj"]; ?></td>
                    <td><?php echo $linha["telefone"]; ?></td>
                    <td><?php echo $linha["cidade"]; ?></td>
                    <td><a href="transportadores.php?codigo=<?php echo $linha["codigo"]; ?>">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>