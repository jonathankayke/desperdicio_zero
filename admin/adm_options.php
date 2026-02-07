<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
    <main class="container">
        <h1 class="breadcrumb text-success">Área Administrativa</h1>
        <div class="row">
            
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail doacoes-card">
                    <br>
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group">
                            <div class="fundo-branco">
                                <span>DOAÇÕES</span>
                            </div>
                        </div> 
                    </div> 
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group">
                            <a href="doacao_lista.php">
                                <button class="botao-verde verde-escuro">Listar</button>
                            </a>
                        </div> 
                        <div class="btn-group">
                            <a href="doacao_insere.php">
                                <button class="botao-verde verde-escuro">Inserir</button>
                            </a>
                        </div> 
                    </div> 
                </div> 
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" style="background-color: #FCF8E3;">
                    <br>
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group">
                            <div class="fundo-branco">
                                <span>TIPOS</span>
                            </div>
                        </div> 
                    </div> 
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group">
                            <a href="tipos_lista.php">
                                <button class="botao-laranja laranja-escuro">Listar</button>
                            </a>
                        </div> 
                        <div class="btn-group">
                            <a href="tipos_insere.php">
                                <button class="botao-laranja laranja-escuro">Inserir</button>
                            </a>
                        </div> 
                    </div> 
                </div> 
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="thumbnail alert-info">
                    <br>
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group">
                            <div class="fundo-branco">
                                <span>USUÁRIOS</span>
                            </div>
                        </div> 
                    </div> 
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group">
                            <a href="usuario_lista.php">
                                <button class="botao-azul azul-escuro">Listar</button>
                            </a>
                        </div> 
                        <div class="btn-group">
                            <a href="usuario_insere.php">
                                <button class="botao-azul azul-escuro">Inserir</button>
                            </a>
                        </div> 
                    </div> 
                </div> 
            </div>

        </div> </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>