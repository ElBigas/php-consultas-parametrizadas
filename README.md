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
