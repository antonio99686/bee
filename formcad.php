<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/carrinho.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style04.css">
    <title>Cadastrar</title>
</head>

<body>
    <header>
        <h1>Supermercado Prata e Ouro</h1>
        <nav>
            <ul>
                <li><a href="formcad.html">Cadastrar Produto</a></li>
                <li><a href="listar.php">Consultar Lista</a></li>
                <li><a href="formedit.html">Editar Produto</a></li>
            </ul>
        </nav>
    </header>

    <div class="mana">
        <h2>Cadastrar Produto</h2>

        <form action="codigo/cadastrar.php" method="post" enctype="multipart/form-data">
            <label for="nome">Nome do Produto:</label><br>
            <input type="text" id="nome" name="nome" required placeholder="Nome"><br><br>

            <label for="quant">Quantidade:</label><br>
            <input type="text" id="quant" name="quant" required placeholder="N° Inteiro"><br><br>

            <label for="valor">Valor:</label><br>
            <input type="text" id="valor" name="valor" required placeholder="N° Inteiro"><br><br>

            <label for="arquivo">Imagem:</label><br>
            <input type="file" id="arquivo" name="arquivo" required><br><br>

            <label for="cargo">Sessão:</label><br>
            <select id="cargo" name="cargo">
                <option value="1">Fruta</option>
                <option value="2">Doce</option>
                <option value="3">Carne</option>
                <option value="4">Produto de limpeza</option>
                <option value="5">Legumes</option>
                <option value="6">Verduras</option>
            </select><br><br>

            <input class="add-to-cart" type="submit" value="Cadastrar">
        </form>

        <form action="index.php">
            <br>
            <input class="add-to-cart" type="submit" value="Voltar">
        </form>
    </div>

    <footer>
        <p>&copy; 2023 Supermercado Prata e Ouro. Todos os direitos reservados.</p>
    </footer>
</body>

</html>