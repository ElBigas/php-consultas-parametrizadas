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
        <form action="pesquisa.php" method="post">
            <div class="mb-3">
                <label class="form-label">
                    <h1>Pesquisa de Usuários</h1>
                </label>
                <input name="nome" type="text" class="form-control" placeholder="Pesquisar nome...">
            </div>

            <button type="submit" class="btn btn-primary">Pesquisar</button>

        </form>
    </div>

</body>

</html>