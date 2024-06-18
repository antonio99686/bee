<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css"> <!-- Substitua pelo seu arquivo CSS personalizado -->
    <title>Lista de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 18px;
        }
        .table {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #333;
            color: white;
        }
        table td img {
            margin-right: 5px;
            vertical-align: middle;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn-container input[type="submit"] {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Supermercado Prata e Ouro</h1>
        <nav>
            <ul>
                <li><a href="formcad.html">Cadastrar Produto</a></li>
                <li><a href="listar.php">Consultar Lista</a></li>
                <li><a href="formedit.html">Editar Produto</a></li>
                <li><a href="carrinho.html"><i class="fa-solid fa-cart-shopping"></i></a></li>
            </ul>
        </nav>
    </header>
    
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Foto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
              require_once 'conexao.php';
              $conexao = conectar();

                // Seleciona todos os dados da tabela lista
                $sql = "SELECT * FROM lista";
                $resultado = mysqli_query($conexao, $sql);

                while ($dados = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . $dados['id_produto'] . "</td>";
                    echo "<td>" . $dados['produto'] . "</td>";
                    echo "<td>" . $dados['quantidade'] . "</td>";
                    echo "<td>" . $dados['valor'] . "</td>";
                    echo "<td>" . $dados['imagem'] . "</td>";
                    echo "<td>";
                    echo "<a href='formedit.php?id=" . $dados['id_produto'] . "&nome=" . $dados['produto'] . "&quant=" . $dados['quantidade'] . "&valor=" . $dados['valor'] . "'><img src='img/settings.png' width='20' height='20'></a>";
                    echo "<a href='codigo/excluir.php?id=" . $dados['id_produto'] . "'><img src='img/lixeira.png' width='20' height='20'></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="btn-container">
        <form action="index.php" method="GET">
            <input type="submit" value="Voltar">
        </form>
    </div>

    <footer>
        <p>&copy; 2023 Supermercado Prata e Ouro. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
