# php-consultas-parametrizadas
Estudo utilizando pesquisas parametrizadas com PHP

<hr />

Antes de parametrizar o SQL para a consulta, o código estava assim:

````php
$nome = $_POST['nome'];

$sql = "SELECT * FROM usuarios WHERE nome LIKE '%$nome'";

$result = $conn->query($sql);
````

Sem a parametrização, era possível realizar uma injeção de SQL no input de nome, que ao invés de mostrar apenas um resultado, todos os usuário eram exibidos. 

Agora parametrizados os resultados, não é mais possível injetar SQL e nem mostrar todos os usuários, apenas aqueles que foram buscados aparecem.

O código agora está assim:

````php
$nome = $_POST['nome'];

// Consulta SQL parametrizada
$sql = "SELECT * FROM usuarios WHERE nome LIKE ?";

// Prepara a consulta
$stmt = $conn->prepare($sql);

// Verifica se a preparação da consulta teve êxito
if ($stmt === false) {
  die("Erro na preparação da consulta.");
}

// Vincula o parâmetro
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

````
