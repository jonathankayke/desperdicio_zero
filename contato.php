<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodapé Desperdício Zero</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body>
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-md-4 text-center" id="contato">
                <h4 class="text-success hidden-lg hidden-md hidden-sm text-center">FALE CONOSCO</h4>
                <h4 class="text-success hidden-xs">FALE CONOSCO</h4>
                <form action="rodape_contato_envia.php" name="form_contato" id="form_contato" method="post">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input type="text" name="nome_contato" class="form-control" placeholder="Seu nome" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                            <input type="email" name="email_contato" class="form-control" placeholder="Seu e-mail"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                            <textarea name="comentarios_contato" class="form-control" rows="4"
                                placeholder="Sua mensagem..." required></textarea>
                        </div>
                    </div>

                    <button class="btn btn-success btn-block">
                        Enviar Mensagem <span class="glyphicon glyphicon-send"></span>
                    </button>
                </form>
            </div>

        </div>
        <hr style="border-color: #ccc;">

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>