<?php
session_start();
include('conexao.php');

// Verifica se o parâmetro 'search' está definido
if(isset($_GET['search'])){
    $searchTerm = $_GET['search'];

    $consulta = "SELECT proximo_id, cpf, nome, telefone FROM cadastro WHERE nome LIKE '%$searchTerm%' OR cpf LIKE '%$searchTerm%' OR telefone LIKE '%$searchTerm%'";
    $resultado = mysqli_query($conn, $consulta);

    if (!$resultado) {
        die("Erro ao buscar clientes: " . mysqli_error($conn));
    }

    $clientes = [];

    if (mysqli_num_rows($resultado) > 0) {
        while ($linha = mysqli_fetch_assoc($resultado)) {
            // Adiciona os dados do cliente ao array de clientes
            $clientes[] = $linha;
        }
    }

    // Retorna os clientes no formato JSON
    echo json_encode($clientes);

    mysqli_close($conn);
} else {
    // Se 'search' não estiver definido, retorna todos os clientes sem filtrar
    $consultaTodos = "SELECT proximo_id, cpf, nome, telefone FROM cadastro";
    $resultadoTodos = mysqli_query($conn, $consultaTodos);

    if (!$resultadoTodos) {
        die("Erro ao buscar clientes: " . mysqli_error($conn));
    }

    $clientesTodos = [];

    if (mysqli_num_rows($resultadoTodos) > 0) {
        while ($linhaTodos = mysqli_fetch_assoc($resultadoTodos)) {
            // Adiciona os dados do cliente ao array de clientes
            $clientesTodos[] = $linhaTodos;
        }
    }

    // Retorna todos os clientes no formato JSON
    echo json_encode($clientesTodos);

    mysqli_close($conn);
}
?>

