<?php
include "includes/conexao.php";

$fretes = [];

if (isset($_GET["data"]) && $_GET["data"] != "") {
    $data = $_GET["data"];

    $sql = "SELECT f.codigo, f.data, t.nome AS transportador,
                   o.nome AS origem, d.nome AS destino,
                   GROUP_CONCAT(p.nome SEPARATOR ', ') AS produtos
            FROM fretes f
            JOIN transportadores t ON t.codigo = f.transportador
            JOIN enderecos o ON o.codigo = f.origem
            JOIN enderecos d ON d.codigo = f.destino
            LEFT JOIN frete_produtos fp ON fp.frete = f.codigo
            LEFT JOIN produtos p ON p.codigo = fp.produto
            WHERE f.data = ?
            GROUP BY f.codigo";

    $comando = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($comando, "s", $data);
    mysqli_stmt_execute($comando);
    $resultado = mysqli_stmt_get_result($comando);

    while ($linha = mysqli_fetch_assoc($resultado)) {
        $fretes[] = $linha;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Fretes </title>
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
    <div class="container mt-4" style="max-width: 1000px; margin-left: 40px;">
        <h2>Relatório de Fretes</h2>

        <form action="relatorio.php" method="get" class="d-flex gap-3 mb-4">
            <input type="date" name="data" class="form-control" style="max-width: 300px;">
            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Buscar</button>
        </form>
            <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-white" style="background-color: #6155F5;">Código</th>
                <th class="text-white" style="background-color: #6155F5;">Data</th>
                <th class="text-white" style="background-color: #6155F5;">Transportador</th>
                <th class="text-white" style="background-color: #6155F5;">Origem</th>
                <th class="text-white" style="background-color: #6155F5;">Destino</th>
                <th class="text-white" style="background-color: #6155F5;">Produtos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($fretes as $frete) { ?>
            <tr>
                <td><?php echo $frete["codigo"]; ?></td>
                <td><?php echo date("d/m/Y", strtotime($frete["data"])); ?></td>
                <td><?php echo $frete["transportador"]; ?></td>
                <td><?php echo $frete["origem"]; ?></td>
                <td><?php echo $frete["destino"]; ?></td>
                <td><?php echo $frete["produtos"]; ?></td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
        <button type="button" onclick="window.print()" class="btn text-white" style="background-color: #6155F5;">Baixar relatório</button>
    </div>

</body>

</html>