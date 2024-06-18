<?php
include('conecta.php');

if(isset($_GET['email']) || isset($_GET['senha'])) {

    if(strlen($_GET['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_GET['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_GET['email']);
        $senha = $mysqli->real_escape_string($_GET['senha']);

        $sql_code = "SELECT * FROM id_usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: index.php");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/font.css">
</head>
<body>
    <div class="page">
        <form method="GET" action="index.php" class="formLogin">
            <h1>Login</h1>
            <p>Digite os seus dados de acesso no campo abaixo.</p>
            <label for="email">Usuario </label>
            <input type="email" placeholder="Usuario" autofocus="true" />
            <label for="password">Senha</label>
            <input type="password" placeholder="Digite sua Senha " />
            <a href="/">Esqueci minha senha</a>
            <input type="submit" value="Acessar" class="btn" />
        </form>
    </div>
    
</body>
</html>