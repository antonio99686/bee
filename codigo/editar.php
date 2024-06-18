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
// Conectar ao BD
require_once '../conexao.php';
$conexao = conectar();

// Função para verificar se é uma imagem
function isImage($file) {
    $validTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    $imageType = exif_imagetype($file);
    return in_array($imageType, $validTypes);
}

// Receber os dados do formulário (use $_POST ao invés de $_GET para envio seguro de dados)
$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$quant = $_POST['quant'] ?? '';
$valor = $_POST['valor'] ?? '';
$categoria = $_POST['cargo'] ?? '';

// Verificar se todos os campos obrigatórios foram preenchidos
if (empty($id) || empty($nome) || empty($quant) || empty($valor) || empty($categoria)) {
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erro ao editar o produto.',
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
    if ($file['error'] != UPLOAD_ERR_OK && $file['error'] != UPLOAD_ERR_NO_FILE) {
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

    // Se foi enviado um novo arquivo, processa-o
    if ($file['error'] == UPLOAD_ERR_OK) {
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
        if (!move_uploaded_file($file['tmp_name'], $caminho_arquivo)) {
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

        // Atualizar os dados no banco de dados, incluindo a nova imagem
        $sql = "UPDATE lista SET produto = '$nome', quantidade = '$quant', valor = '$valor', imagem = '$novo_nome', categoria = '$categoria' WHERE idLista = $id";
    } else {
        // Se não foi enviado um novo arquivo, atualiza apenas os dados do produto sem alterar a imagem
        $sql = "UPDATE lista SET produto = '$nome', quantidade = '$quant', valor = '$valor', categoria = '$categoria' WHERE idLista = $id";
    }

    if (mysqli_query($conexao, $sql)) {
        // Mensagem de sucesso com SweetAlert2
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Produto atualizado com sucesso!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = '../index.php';
                });
              </script>";
    } else {
        // Mensagem de erro ao atualizar no banco de dados
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erro ao atualizar o produto.',
                    text: 'Por favor, tente novamente mais tarde.',
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
