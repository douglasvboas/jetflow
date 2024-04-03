<?php
session_start();
include_once("conexao.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $cpf = $_POST["cpf"];
    $data_cadastro = $_POST['data_cadastro'];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $email = $_POST["email"];
    $marca_modelo = $_POST["marca_modelo"];
    $ano_fabricacao = $_POST["ano_fabricacao"]; 


    // Conectar ao banco de dados
    $conn = new mysqli("localhost:3312", "root", "", "jetflow_cadastro");

    // Verifica se houve algum erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO cadastro (cpf, data_cadastro, nome, telefone, email, marca_modelo, ano_fabricacao) VALUES (?, ?, ?, ?, ?, ?, ? )";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a declaração SQL foi preparada com sucesso
    if ($stmt === false) {
        die("Erro na preparação da declaração SQL: " . $conn->error);
    }

    // Associa os parâmetros à declaração SQL
    $stmt->bind_param("sssssss",$cpf, $data_cadastro, $nome, $telefone, $email, $marca_modelo, $ano_fabricacao);

    // Executa a declaração SQL
    if ($stmt->execute()) {
        // Recupera o ID gerado automaticamente
        $id_gerado = $conn->insert_id;
        // Exibe o alerta
        echo "<script>
                // Exibe o alerta
                document.getElementById('alerta').style.display = 'block';
                // Fecha o alerta após 3 segundos
                setTimeout(function(){
                    document.getElementById('alerta').style.display = 'none';
                    // Redireciona após fechar o alerta
                    window.location.href = 'cadastro.html'; 
                }, 3000); // Tempo em milissegundos (3 segundos)
              </script>";
    } else {
        echo "Erro ao inserir os dados: " . $stmt->error;
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt->close();
    $conn->close();
} else {
    // Se o método de requisição não for POST, exibe uma mensagem de erro
    echo "Método de requisição inválido!";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Adicione o código JavaScript para exibir o alerta -->
    <script>
        // Exibe o alerta
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('alerta').style.display = 'block';
            // Fecha o alerta após 3 segundos
            setTimeout(function(){
                document.getElementById('alerta').style.display = 'none';
                // Redireciona após fechar o alerta
                window.location.href = 'cadastro.html'; 
            }, 3000); // Tempo em milissegundos (3 segundos)
        });
    </script>
</head>
<body>
    <!-- Adicione o elemento com o ID "alerta" -->
    <div id="alerta" style="display: none;">
        Dados inseridos com sucesso!
    </div>
</body>
</html>