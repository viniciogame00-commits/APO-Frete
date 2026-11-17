<?php
include "includes/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Frete</title>
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
        <h2>Cadastro de Frete</h2>

        <form action="fretes.php" method="post">

            <div class="mb-3">
                <label class="form-label">Data</label>
                <input type="date" name="data" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Transportador</label>
                <select name="transportador" class="form-select">
                    <option value="">Selecione...</option>
                    <?php
                   $resultado = mysqli_query($conexao, "SELECT * FROM transportadores");
                   while ($linha = mysqli_fetch_assoc($resultado)) {
                   echo "<option value='" . $linha["codigo"] . "'>" . $linha["nome"] . "</option>";
                   }
                   ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Origem</label>
                <select name="origem" class="form-select">
                    <option value="">Selecione...</option>
                    <?php
                   $resultado = mysqli_query($conexao, "SELECT * FROM enderecos");
                   while ($linha = mysqli_fetch_assoc($resultado)) {
                   echo "<option value='" . $linha["codigo"] . "'>" . $linha["nome"] . "</option>";
                   }
                   ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Destino</label>
                <select name="destino" class="form-select">
                    <option value="">Selecione...</option>
                    <?php
                   $resultado = mysqli_query($conexao, "SELECT * FROM enderecos");
                   while ($linha = mysqli_fetch_assoc($resultado)) {
                   echo "<option value='" . $linha["codigo"] . "'>" . $linha["nome"] . "</option>";
                   }
                   ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Produtos</label>
                <div id="lista-produtos">
                    <select name="produtos[]" class="form-select">
                        <option value="">Selecione o produto...</option>
                        <?php
                        $resultado = mysqli_query($conexao, "SELECT * FROM produtos");
                        while ($linha = mysqli_fetch_assoc($resultado)) {
                        echo "<option value='" . $linha["codigo"] . "'>" . $linha["nome"] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="button" onclick="adicionarProduto()" class="btn mb-3"
                style="border: 1px solid #6155F5; color: #6155F5;">+ Adicionar produto</button>
            <br>
            <button type="submit" class="btn text-white" style="background-color: #6155F5;">Gerar frete</button>

        </form>
    </div>
    <script>
    function adicionarProduto() {
        var lista = document.getElementById("lista-produtos");
        var copia = lista.querySelector("select").cloneNode(true);
        copia.classList.add("mt-2");
        lista.appendChild(copia);
    }
    </script>
</body>

</html>