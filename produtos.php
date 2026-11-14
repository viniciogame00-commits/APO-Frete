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

    <form action="produtos.php" method="post">

        <div class="mb-3">
            <label class="form-label">Código</label>
            <input type="text" name="codigo" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Peso</label>
            <input type="number" step="0.01" name="peso" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Medidas</label>
            <input type="text" name="medidas" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantidade</label>
            <input type="number" name="quantidade" class="form-control">
        </div>
            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Salvar</button>
    </form>

</div>

</body>
</html>