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
        <section class="category-container">
            <div class="category-card legumes">
                <h1>Sessão de Frutas</h1>
                <form action="fruta.php" method="GET">
                    <h3>Venha conferir</h3>
                    <input class="add-to-cart" type="submit" value="Entrar" />
                </form>
            </div>
            <div class="category-card frutas">
                <h1>Sessão de Legumes</h1>
                <form action="legumes.php" method="GET">
                    <h3>Venha conferir</h3>
                    <input class="add-to-cart" type="submit" value="Entrar" />
                </form>
            </div>
            <div class="category-card carnes">
                <h1>Sessão de Carnes</h1>
                <form action="carne.php" method="GET">
                    <h3>Venha conferir</h3>
                    <input class="add-to-cart" type="submit" value="Entrar" />
                </form>
            </div>
            <div class="category-card produtos">
                <h1>Sessão de Produtos de Limpeza</h1>
                <form action="limpeza.php" method="GET">
                    <h3>Venha conferir</h3>
                    <input class="add-to-cart" type="submit" value="Entrar" />
                </form>
            </div>
            <div class="category-card produtos">
                <h1>Sessão de Doces</h1>
                <form action="doces.php" method="GET">
                    <h3>Venha conferir</h3>
                    <input class="add-to-cart" type="submit" value="Entrar" />
                </form>
            </div>
            <!-- Adicione mais categorias aqui, se necessário -->
        </section>
    </main>

    <script src="/script.js"></script>

    <footer>
        <p>&copy; 2024 Supermercado Prata e Ouro. Todos os direitos reservados.</p>
    </footer>
</body>

</html>