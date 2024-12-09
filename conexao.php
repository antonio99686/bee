<?php

/**
 * Faz uma conexão com o banco de dados MySQL, 
 * utilizando as configurações do arquivo config.php.
 * 
 * @return \mysqli retorna uma conexão com a base de dados, ou em caso 
 * de falha, mata a execução e exibe o erro.
 */
function conectar()
{
    require_once "confg.php"; // Inclui o arquivo de configuração

    // Estabelece a conexão com o banco de dados
    $conexao = mysqli_connect(
        $config['host'],
        $config['user'],
        $config['pass'],
        $config['db']
    );

    // Verifica se a conexão foi bem-sucedida
    if ($conexao === false) {
        echo "Erro ao conectar à base de dados. Nº do erro: " . mysqli_connect_errno() . ". " . mysqli_connect_error();
        die(); // Interrompe a execução se houver erro
    }

    // Retorna a conexão para uso posterior
    return $conexao;
}

/**
 * Executa um comando SQL e retorna o resultado.
 * Pode ser usado para SELECT, INSERT, UPDATE, DELETE.
 *
 * @param \mysqli $conexao Conexão com o banco de dados.
 * @param string $sql Comando SQL a ser executado.
 * @return mixed O resultado da execução do SQL.
 */
function executarSQL($conexao, $sql)
{
    // Executa o comando SQL
    $resultado = mysqli_query($conexao, $sql);

    // Verifica se houve erro na execução
    if ($resultado === false) {
        echo "Erro ao executar o comando SQL. " . mysqli_errno($conexao) . ": " . mysqli_error($conexao);
        die(); // Interrompe a execução em caso de erro
    }

    return $resultado;
}

/**
 * Função para recuperar resultados de um SELECT.
 *
 * @param \mysqli $conexao Conexão com o banco de dados.
 * @param string $sql Comando SQL SELECT a ser executado.
 * @return array Retorna um array associativo com os resultados.
 */
function recuperarResultados($conexao, $sql)
{
    $resultado = executarSQL($conexao, $sql);
    $dados = [];

    // Verifica se o comando retornou algum dado
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $dados[] = $linha; // Adiciona a linha ao array
    }

    return $dados;
}

/**
 * Função para fechar a conexão com o banco de dados.
 *
 * @param \mysqli $conexao Conexão com o banco de dados.
 */
function fecharConexao($conexao)
{
    mysqli_close($conexao); // Fecha a conexão com o banco de dados
}

?>
