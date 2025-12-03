<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h1 class="breadcrumb alert-success text-center">Lista de Usuários</h1>
            <div class="btn btn-success disabled">
                Total de Usuários:
            </div>
            <table class="table table-hover table-condensed tbopacidade">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Senha</th> <!-- ocultar -->
                        <th>Tipo</th>
                        <th>Telefone</th>
                        <th>
                            <a href="usuario_insere.php" class="btn btn-primary btn-block btn-xs">
                                <span>ADICIONAR<br> </span>
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
