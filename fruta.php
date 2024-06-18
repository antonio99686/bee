<?php
require_once "conexao.php";
$conexao = conectar();

// Verifica se a conexão foi estabelecida
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$sql = "SELECT * FROM lista WHERE categoria = 1";
$resultado = mysqli_query($conexao, $sql);
sleep(1);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/carrinho.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Supermercado Prata e Ouro</title>
</head>

<body>

    <header>
        <h1>Supermercado Prata e Ouro</h1>
        <nav>
            <ul>
                <li><a href="formcad.php">Cadastrar Produto</a></li>
                <li><a href="listar.php">Consultar Lista</a></li>
                <li><a href="formedit.php">Editar Produto</a></li>
                <li><a href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Produtos</h2>
        <div class="category-container">
            <?php
            while ($dados = mysqli_fetch_assoc($resultado)) {
                ?>
                <div class="category-card box-shadow">
                    <img src="img/<?php echo $dados['imagem']; ?>" height="180px" width="190px" alt="<?php echo $dados['produto']; ?>">
                    <div class="product-details">
                        <h3><?php echo $dados['produto']; ?></h3>
                        <span class="price">R$ <?php echo $dados['valor']; ?></span>
                        <br>
                        <button class="add-to-cart"
                            onclick="adicionarProduto('<?php echo $dados['produto']; ?>', <?php echo $dados['valor']; ?>)">Adicionar
                            ao Carrinho</button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="ums">
            <h2>Carrinho de Compras</h2>
            <ul id="carrinho">
                <p>Total: R$ <span id="total">0.00</span></p>
            </ul>
            <button onclick="exibirRecibo()">Finalizar Compra</button>
        </div>
    </main>

    <script src="JavaScript/bee.js"></script>

    <footer>
        <p>&copy; 2024 Supermercado Prata e Ouro. Todos os direitos reservados.</p>
    </footer>
</body>

</html>
