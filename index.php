<?php
// Conectar ao banco de dados
require_once "conexao.php";
$conexao = conectar();

// Consultar produtos para ofertas
$sql = "SELECT * FROM produtos ORDER BY RAND() LIMIT 3"; // Exemplo de consulta para pegar 3 produtos aleatórios
$resultado = recuperarResultados($conexao, $sql);

// Exibir os produtos
foreach ($resultado as $produto) {
    echo "<h3>" . $produto['nome'] . "</h3>";
    echo "<p>Preço: R$" . number_format($produto['preco'], 2, ',', '.') . "</p>";
}

// Fechar a conexão
fecharConexao($conexao);
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
    <style>
        /* Estilo geral da página */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
        }

        /* Cabeçalho */
        header {
            background: url('img/aces/mercado.webp') no-repeat center center/cover;
            color: white;
            text-align: center;
            padding: 100px 0;
        }

        header h1 {
            font-size: 3.5em;
            margin-bottom: 0.5em;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        header p {
            font-size: 1.2em;
            margin-bottom: 1.5em;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        /* Botões principais */
        .main-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .main-buttons a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border-radius: 5px;
            font-size: 1.2em;
            transition: background-color 0.3s ease, transform 0.3s ease;
            text-align: center;
            width: 180px;
        }

        .main-buttons a:hover {
            background-color: #45a049;
            transform: scale(1.05);
        }

        /* Sessões de categorias */
        .category-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2em;
            padding: 3em 10%;
        }

        .category-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2em;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .category-card h1 {
            font-size: 1.8em;
            margin-bottom: 1em;
            color: #4CAF50;
        }

        .add-to-cart {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1.1em;
        }

        .add-to-cart:hover {
            background-color: #45a049;
        }

        /* Ofertas do dia */
        .offers-section {
            background-color: #f1f1f1;
            padding: 3em 10%;
            text-align: center;
        }

        .offers-section h2 {
            font-size: 2.5em;
            margin-bottom: 1.5em;
            color: #4CAF50;
        }

        .offers-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2em;
        }

        .offer-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 2em;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .offer-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .offer-card img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .offer-card h3 {
            font-size: 1.5em;
            margin: 1em 0;
            color: #4CAF50;
        }

        .offer-card .old-price {
            text-decoration: line-through;
            color: #888;
        }

        .offer-card .discount-price {
            font-size: 1.5em;
            color: #e74c3c;
            margin-top: 0.5em;
        }

        /* Rodapé */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1.5em;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>

<body>

    <header>
        <h1>Supermercado Prata e Ouro</h1>
        <p>Qualidade e preço baixo em um só lugar!</p>
        <div class="main-buttons">
            <a href="formcad.php">Cadastrar Produto</a>
            <a href="listar.php">Consultar Lista</a>
            <a href="carrinho.php"><i class="fa-solid fa-cart-shopping"></i> Carrinho</a>
        </div>
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
            <div class="category-card doces">
                <h1>Sessão de Doces</h1>
                <form action="doces.php" method="GET">
                    <h3>Venha conferir</h3>
                    <input class="add-to-cart" type="submit" value="Entrar" />
                </form>
            </div>
        </section>

        <!-- Seção de Ofertas do Dia -->
        <section class="offers-section">
            <h2>Ofertas do Dia</h2>
            <div class="offers-container">
                <?php
                // Verifica se há produtos para mostrar
                if (count($produtos) > 0) {
                    foreach ($produtos as $produto) {
                ?>
                        <div class="offer-card">
                            <img src="img/<?php echo $produto['imagem']; ?>" alt="Oferta de <?php echo $produto['nome']; ?>">
                            <h3><?php echo $produto['nome']; ?> - <?php echo $produto['descricao']; ?></h3>
                            <p class="old-price">R$ <?php echo number_format($produto['preco_original'], 2, ',', '.'); ?></p>
                            <p class="discount-price">R$ <?php echo number_format($produto['preco_promocional'], 2, ',', '.'); ?></p>
                            <button class="add-to-cart">Comprar</button>
                        </div>
                <?php
                    }
                } else {
                    echo '<p>Não há ofertas disponíveis no momento.</p>';
                }
                ?>
            </div>
        </section>

    </main>

    <footer>
        <p>&copy; 2024 Supermercado Prata e Ouro. Todos os direitos reservados.</p>
    </footer>

</body>

</html>