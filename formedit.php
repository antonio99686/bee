<?php
// Conectar ao BD
require_once 'conexao.php';
$conexao = conectar();
$sql = "SELECT * FROM lista ";
$resultado = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($resultado)
?>
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
                <li><a href="formcad.php">Cadastrar Produto</a></li>
                <li><a href="listar.php">Consultar Lista</a></li>
                <li><a href="formedit.php">Editar Produto</a></li>
            </ul>
        </nav>
    </header>

    <div class="mana">
    <h1>Editar Produto</h1>
        <form action="codigo/editar.php" method="post" enctype="multipart/form-data">
          
            <label for="nome">Nome do produto:</label><br>
            <input type="text" id="nome" name="nome" value="<?php echo $dados['produto'];?>" required><br>
            <label for="quant">Quantidade:</label><br>
            <input type="text" id="quant" name="quant" value="<?php echo $dados['quantidade'];?>" required><br>
            <label for="valor">Valor:</label><br>
            <input type="text" id="valor" name="valor" value="<?php echo $dados['valor'];?>" required><br>
            <label for="arquivo">Imagem:</label><br>
            <input type="file" id="arquivo" name="arquivo"><br><br>
            <input class="add-to-cart" type="submit" value="Editar"><br>
        </form>
        <form action="index.php" method="GET">
            <br>
            <input class="add-to-cart" type="submit" value="Voltar">
        </form>
    </div>

    <footer>
        <p>&copy; 2023 Supermercado Prata e Ouro. Todos os direitos reservados.</p>
    </footer>
</body>

</html>