<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");

// Consulta para trazer os dados
$consulta = "SELECT * FROM vw_doacoes ORDER BY nome_alimento ASC";
$lista = $conn_alimentos->query($consulta);
$totalRows = ($lista)->num_rows;
?>
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

<body class="fundofixo">
    <?php include('menu_publico.php'); ?>
    <div class="container"
        style="margin-top:30px; max-width: 800px; margin: 40px auto; background: #ffffff; padding: 30px 40px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">
        <div class="row breadcrumb fundoverde-claro">
           
                <!-- COLUNA INFORMAÇÕES -->
                <div class="col-sm-12 col-md-6">

                    <h3>Informações</h3>
                    <br>

                    <h4>Telefone</h4>
                    <p>(15) 4002-8922</p>

                    <h4>Email</h4>
                    <p>contato@desperdiciozero.com.br</p>

                    <h4>Endereço</h4>
                    <p>R. Dom Joaquim, 495 - Centro, Itapetininga - SP, 18200-090</p>
                </div>

                <!-- COLUNA MAPA -->
                <div class="col-sm-12 col-md-6">
                    <div class="mapa-responsivo">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.3526033163653!2d-48.05545982387314!3d-23.59168407877899!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5cc93b46246ed%3A0x6ec0870ce87bb6fd!2sSenac%20Itapetininga!5e0!3m2!1spt-BR!2sbr!4v1771889936931!5m2!1spt-BR!2sbr"
                            width="100%" height="300" style="border:1px solid #ccc; border-radius: 6px;"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>
                </div>

            </div>
        
        <br><br>

        <!-- FORMULÁRIO -->
        <div class="row">
            <div class="col-sm-12">
                <h4 class="text-success text-center">FALE CONOSCO</h4>

                <form action="rodape_contato_envia.php" method="post">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </span>
                            <input type="text" name="nome_contato" class="form-control" placeholder="Seu nome" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </span>
                            <input type="email" name="email_contato" class="form-control" placeholder="Seu e-mail"
                                required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </span>
                            <textarea name="comentarios_contato" class="form-control" rows="5"
                                placeholder="Sua mensagem..." required></textarea>
                        </div>
                    </div>

                    <button class="btn btn-success btn-block" style="padding: 10px;">
                        Enviar Mensagem
                        <span class="glyphicon glyphicon-send"></span>
                    </button>

                </form>
            </div>
        </div>
        <hr style="border-color: #ccc;">
    </div>
    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php mysqli_free_result($lista); ?>