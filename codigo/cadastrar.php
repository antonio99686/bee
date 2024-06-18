<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Cadastrar</title>
</head>
<body>
    
</body>
</html>
<?php
require_once '../conexao.php'; // Verifique se o nome do arquivo de conexão está correto
$conexao = conectar();

// Função para verificar se é uma imagem
function isImage($file) {
    $validTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    $imageType = exif_imagetype($file);
    return in_array($imageType, $validTypes);
}

// Receber os dados do formulário (use $_POST ao invés de $_GET para envio seguro de dados)
$nome = $_POST['nome'] ?? '';
$quant = $_POST['quant'] ?? '';
$valor = $_POST['valor'] ?? '';
$categoria = $_POST['cargo'] ?? '';

// Verificar se todos os campos obrigatórios foram preenchidos
if (empty($nome) || empty($quant) || empty($valor) || empty($categoria)) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao cadastrar o produto.',
                text: 'Por favor, preencha todos os campos.',
                showConfirmButton: false,
                timer: 3000
            }).then(function() {
                window.location.href = '../index.php';
            });
          </script>";
    exit;
}

// Verificar se o formulário foi submetido e o arquivo enviado
if (isset($_FILES['arquivo'])) {
    $file = $_FILES['arquivo'];

    // Verificar se houve erro no upload do arquivo
    if ($file['error'] != UPLOAD_ERR_OK) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao enviar o arquivo.',
                    text: 'Por favor, tente novamente.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(function() {
                    window.location.href = '../index.php';
                });
              </script>";
        exit;
    }

    // Verificar o tipo de arquivo (apenas imagens)
    if (!isImage($file['tmp_name'])) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao enviar o arquivo.',
                    text: 'Por favor, envie apenas arquivos de imagem (JPEG, PNG, GIF).',
                    showConfirmButton: false,
                    timer: 3000
                }).then(function() {
                    window.location.href = '../index.php';
                });
              </script>";
        exit;
    }

    // Verificar o tamanho máximo do arquivo (5MB)
    $maxFileSize = 5 * 1024 * 1024; // 5MB em bytes
    if ($file['size'] > $maxFileSize) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao enviar o arquivo.',
                    text: 'O arquivo excede o tamanho máximo permitido (5MB).',
                    showConfirmButton: false,
                    timer: 3000
                }).then(function() {
                    window.location.href = '../index.php';
                });
              </script>";
        exit;
    }

    // Diretório onde os arquivos serão salvos
    $diretorio = "../img/";

    // Nome do arquivo com timestamp para evitar sobrescrita
    $novo_nome = time() . '_' . $file['name'];

    // Caminho completo do arquivo
    $caminho_arquivo = $diretorio . $novo_nome;

    // Move o arquivo para o diretório especificado
    if (move_uploaded_file($file['tmp_name'], $caminho_arquivo)) {
        // Sanitizar os dados antes de inserir no banco de dados (exemplo)
        $nome = mysqli_real_escape_string($conexao, $nome);
        $quant = mysqli_real_escape_string($conexao, $quant);
        $valor = mysqli_real_escape_string($conexao, $valor);
        $categoria = mysqli_real_escape_string($conexao, $categoria);

        // Inserir no banco de dados
        $sql = "INSERT INTO lista (produto, quantidade, valor, imagem, categoria) 
                VALUES ('$nome', '$quant', '$valor', '$novo_nome', '$categoria')";

        if (mysqli_query($conexao, $sql)) {
            // Mensagem de sucesso com SweetAlert2
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Produto cadastrado com sucesso!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = '../index.php';
                    });
                  </script>";
        } else {
            // Mensagem de erro ao inserir no banco de dados
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro ao cadastrar o produto.',
                        text: 'Por favor, tente novamente mais tarde.',
                        showConfirmButton: false,
                        timer: 3000
                    }).then(function() {
                        window.location.href = '../index.php';
                    });
                  </script>";
        }
    } else {
        // Mensagem de erro ao mover o arquivo
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao enviar o arquivo.',
                    text: 'Por favor, tente novamente.',
                    showConfirmButton: false,
                    timer: 3000
                }).then(function() {
                    window.location.href = '../index.php';
                });
              </script>";
    }
} else {
    // Caso não tenha sido enviado arquivo
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao enviar o arquivo.',
                text: 'Por favor, selecione um arquivo para enviar.',
                showConfirmButton: false,
                timer: 3000
            }).then(function() {
                window.location.href = '../index.php';
            });
          </script>";
}
?>
