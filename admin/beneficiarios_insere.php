<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beneficiários Insere</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body>
    <main class="container">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6"> <!-- abre row -->
            <h2 class="breadcrumb text-success">
                <a href="beneficiarios_lista.php">
                    <button class="btn btn-success">
                        <span class="glyphicon glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Inserindo Usuários
            </h2>
            <div class="thumbnail"> <!-- thumbnail -->
                <div class="alert alert-success" role="alert"> <!-- alert -->
                    <form action="beneficiarios_insere.php" enctype="multipart/form-data" method="post" id="form_beneficiarios_insere" name="form_beneficiarios_insere">

                        <!-- text login_beneficiarios -->
                        <label for="nome_beneficiario">Nome</label>
                        <div class="input-group"> <!-- abre input-group -->
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" name="nome_beneficiario" id="nome_beneficiario" class="form-control" placeholder="Nome Aqui." maxlength="100" required>
                        </div> <!-- fecha input-group -->
                        
                        <label for="cpf_beneficiario">CPF</label>
                        div
                    </form>
                </div>
            </div>
        </div> <!-- fecha row -->
    </main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>