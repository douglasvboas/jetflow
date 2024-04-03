<?php
session_start();
include_once("conexao.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera os dados do formulário
    $cpf         = $_POST["cpf"];
    $data        = $_POST["data"];
    $nome        = $_POST["nome"];
    $marca       = $_POST["marca"];
    $items       = $_POST["item"]; // Renomeado para evitar conflitos com a variável $item
    $descricoes  = $_POST["descricao"]; // Renomeado para evitar conflitos com a variável $descricao
    $quantidades = $_POST["quantidade"];
    $precos      = $_POST["preco"];
    $total       = $_POST["total"];

    // Converte os arrays em strings separadas por vírgula
    $itemString = implode(", ", $items);
    $descricaoString = implode(", ", $descricoes);
    $quantidadeString = implode(", ", $quantidades);
    $precoString = implode(", ", $precos);

    // Prepara a consulta SQL para inserir os dados
    $sql = "INSERT INTO orcamento (cpf, nome, data, marca, item, descricao, quantidade, preco, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepara a declaração SQL
    $stmt = $conn->prepare($sql);

    // Verifica se a declaração SQL foi preparada com sucesso
    if ($stmt === false) {
        die("Erro na preparação da declaração SQL: " . $conn->error);
    }

    // Associa os parâmetros à declaração SQL
    $stmt->bind_param("ssssssssd", $cpf, $nome, $data, $marca, $itemString, $descricaoString, $quantidadeString, $precoString, $total);

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
                    window.location.href = 'consultaOrcamento.html'; 
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
                window.location.href = 'consultaOrcamento.html'; 
            }, 3000); // Tempo em milissegundos (3 segundos)
        });
                                        // Função para incrementar a data
                                        function incrementDate() {
                                            // Obter o valor atual da data
                                            var currentDate = document.getElementById('inputDate').value;

                                            // Verificar se a data está no formato correto
                                            var dateRegex = /^\d{2}\/\d{2}\/\d{4}$/;
                                            if (!dateRegex.test(currentDate)) {
                                                alert('Por favor, insira a data no formato DD/MM/AAAA');
                                                return;
                                            }

                                            // Converter a string de data em um objeto Date
                                            var parts = currentDate.split('/');
                                            var day = parseInt(parts[0], 10);
                                            var month = parseInt(parts[1], 10) - 1; // Os meses em JavaScript começam do zero
                                            var year = parseInt(parts[2], 10);
                                            var dateObject = new Date(year, month, day);

                                            // Incrementar a data em um dia
                                            dateObject.setDate(dateObject.getDate() + 1);

                                            // Formatando a nova data no formato DD/MM/AAAA
                                            var newDate = ('0' + dateObject.getDate()).slice(-2) + '/' + ('0' + (dateObject.getMonth() + 1)).slice(-2) + '/' + dateObject.getFullYear();

                                            // Atualizar o valor do campo de entrada
                                            document.getElementById('inputDate').value = newDate;
                                        }
                                    </script>
</head>
<body>
    <!-- Adicione o elemento com o ID "alerta" -->
    <div id="alerta" style="display: none;">
        Dados inseridos com sucesso!
    </div>
</body>
</html>