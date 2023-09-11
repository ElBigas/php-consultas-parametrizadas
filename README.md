# php-consultas-parametrizadas
Estudo utilizando pesquisas parametrizadas com PHP

<hr />

````php
$nome = $_POST['nome'];

            // Consulta SQL para pesquisar usuários com nome que sejam iguais aos que vem do form de 'index.php'
            $sql = "SELECT * FROM usuarios WHERE nome LIKE '%$nome'";

            // Execute a query
            $result = $conn->query($sql);
````
