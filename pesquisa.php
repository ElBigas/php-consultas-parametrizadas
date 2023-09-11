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

            // Consulta SQL para pesquisar usuários com nome que sejam iguais aos que vem do form de 'index.php'
            $sql = "SELECT * FROM usuarios WHERE nome LIKE '%$nome'";

            // Execute a query
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Resultados da Pesquisa:</h2>";
                while ($row = $result->fetch_assoc()) {
                    echo "ID: " . $row["id"] . "<br>";
                    echo "Nome: " . $row["nome"] . "<br>";
                    echo "Email: " . $row["email"] . "<br>";
                    echo "<hr>";
                }
            } else {
                echo '<div style="text-align: center;" class="alert alert-danger mt-3">Nome não existe no banco de dados!</div>';
            }
        }

        $conn->close();

        ?>
    </div>
</body>