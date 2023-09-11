<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Exercícios - PHP e integração com banco de dados</title>
</head>

<body>
    <div class="container mt-5 ">
        <?php

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('BASE', 'servicedesk');

        $conn = new mysqli(HOST, USER, PASS, BASE);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nome = $_POST['nome'];

            // Consulta SQL parametrizada
            $sql = "SELECT * FROM usuarios WHERE nome LIKE ?";

            // Preparar a consulta
            $stmt = $conn->prepare($sql);

            // Verificar se a preparação da consulta teve êxito
            if ($stmt === false) {
                die("Erro na preparação da consulta.");
            }

            // Vincular o parâmetro
            $nomeParametro = "%$nome";  // Adicionar '%' antes do nome para fazer uma pesquisa que comece com o valor
            $stmt->bind_param("s", $nomeParametro);  // "s" indica que estamos passando uma string


            // Executa a consulta
            if ($stmt->execute()) {

                $result = $stmt->get_result();

                // Se houver resultados vai exibir os dados do usuário, caso contrário vai aparecer uma mensagem de erro
                if ($result->num_rows > 0) {

                    echo "<h2>Resultados da Pesquisa:</h2>";

                    while ($row = $result->fetch_assoc()) {

                        echo "ID: " . $row["id"] . "<br>";
                        echo "Nome: " . $row["nome"] . "<br>";
                        echo "Email: " . $row["email"] . "<br>";
                        echo "<hr>";
                    }

                } else {
                    echo '<div style="text-align: center;" class="alert alert-danger mt-3">Nenhum resultado encontrado!</div>';
                }

                
                $result->close();

            } else {

                die("Erro na execução da consulta.");
            }

            // Fecha a consulta preparada
            $stmt->close();
        }

        $conn->close();

        ?>
    </div>
</body>