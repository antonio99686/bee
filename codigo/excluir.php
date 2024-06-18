<?php
require_once '../conexao.php';
$conexao = conectar();

$id = $_GET['id'];

// Verificar se o ID foi recebido corretamente
if (!isset($id) || empty($id)) {
    // Redirecionar de volta para a página listar.php se o ID estiver ausente
    header('Location: listar.php');
    exit;
}

// Conectar ao banco de dados
$conexao = conectar();

// Verificar se a conexão foi estabelecida corretamente
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Selecionar o produto para obter o nome da imagem
$sql = "SELECT * FROM lista WHERE id_produto=$id";
$resultado = mysqli_query($conexao, $sql);

// Verificar se encontrou o produto com o ID especificado
if (mysqli_num_rows($resultado) > 0) {
    $produto = mysqli_fetch_assoc($resultado);

    // Caminho completo da imagem no diretório
    $caminho_imagem = "img/" . $produto['imagem'];

    // Verificar se o arquivo de imagem existe antes de tentar excluir
    if (file_exists($caminho_imagem)) {
        // Excluir a imagem do diretório
        unlink($caminho_imagem);
    }

    // Query para excluir o produto do banco de dados
    $sql = "DELETE FROM lista WHERE id_produto = $id";

    // Executar a query de exclusão
    if (mysqli_query($conexao, $sql)) {
        // Redirecionar para listar.php após a exclusão
        header('Location: listar.php');
        exit;
    } else {
        echo "Erro ao excluir o produto: " . mysqli_error($conexao);
    }
} else {
    echo "Produto não encontrado.";
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
