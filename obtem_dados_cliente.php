<?php
session_start();
include('conexao.php');

// Verifica se o parâmetro 'id' está definido
if(isset($_GET['id'])){
    $clientId = $_GET['id'];

    // Consulta SQL para buscar os dados do cliente com base no ID
    $consulta = "SELECT cpf, nome, telefone, email, marca_modelo, ano_fabricacao, data_cadastro FROM cadastro WHERE proximo_id = $clientId";
    $resultado = mysqli_query($conn, $consulta);

    if (!$resultado) {
        die("Erro ao obter os dados do cliente: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($resultado) > 0) {
        $clientData = mysqli_fetch_assoc($resultado);

        // Limpa qualquer saída anterior
        ob_clean();

        // Define o tipo de conteúdo como JSON
        header('Content-Type: application/json');

        // Retorna os dados do cliente como JSON
        echo json_encode($clientData);
    } else {
        // Limpa qualquer saída anterior
        ob_clean();

        // Define o tipo de conteúdo como JSON
        header('Content-Type: application/json');

        // Retorna uma mensagem de erro como JSON
        echo json_encode(array('error' => 'Cliente não encontrado'));
    }

    mysqli_close($conn);
} else {
    // Limpa qualquer saída anterior
    ob_clean();

    // Define o tipo de conteúdo como JSON
    header('Content-Type: application/json');

    // Retorna uma mensagem de erro como JSON
    echo json_encode(array('error' => 'ID do cliente não especificado'));
}
?>