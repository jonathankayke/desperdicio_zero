<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rodapé Desperdício Zero</title>

</head>

<body>

    <footer class="rodape-full">
        <div class="container">
            <div class="row">
                <br><br>
                <!-- Celular -->
                <div class="col-sm-6 col-md-4 hidden-lg hidden-md hidden-sm text-center">
                    <h4 class="text-success">LOCALIZAÇÃO</h4>
                    <address>
                        <strong>Senac Itapetininga</strong><br>
                        <i>R. Dom Joaquim, 495 - Centro<br>
                        Itapetininga - SP, 18200-090</i>
                        <br><br>
                        <span class="glyphicon glyphicon-phone-alt"></span> (15) 4002-8922<br>
                        <span class="glyphicon glyphicon-envelope"></span> contato@desperdiciozero.com.br
                    </address>
                    
                    <div class="mapa-responsivo">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.3526033163653!2d-48.05545982387314!3d-23.59168407877899!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5cc93b46246ed%3A0x6ec0870ce87bb6fd!2sSenac%20Itapetininga!5e0!3m2!1spt-BR!2sbr!4v1771889936931!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <!-- Computador -->
                <div class="col-sm-6 col-md-4 hidden-xs">
                    <h4 class="text-success">LOCALIZAÇÃO</h4>
                    <address>
                        <strong>Senac Itapetininga</strong><br>
                        <i>R. Dom Joaquim, 495 - Centro<br>
                        Itapetininga - SP, 18200-090</i>
                        <br><br>
                        <span class="glyphicon glyphicon-phone-alt"></span> (15) 4002-8922<br>
                        <span class="glyphicon glyphicon-envelope"></span> contato@desperdiciozero.com.br
                    </address>
                    
                    <div class="mapa-responsivo">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.3526033163653!2d-48.05545982387314!3d-23.59168407877899!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5cc93b46246ed%3A0x6ec0870ce87bb6fd!2sSenac%20Itapetininga!5e0!3m2!1spt-BR!2sbr!4v1771889936931!5m2!1spt-BR!2sbr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <!-- Celular -->
                <div class="col-sm-6 col-md-4 hidden-lg hidden-md hidden-sm text-center ">            
                <h4 class="text-success ">NAVEGAÇÃO</h4>
                    <ul class="nav nav-pills nav-stacked">
                        <li>
                            <a href="index.php#home" class="text-success text-center">
                                <span class="glyphicon glyphicon-home"></span> HOME
                            </a>
                        </li>
                        <li>
                            <a href="index.php#doacoes" class="text-success text-center">
                                <span class="glyphicon glyphicon-globe"></span> DOAÇÕES
                            </a>
                        </li>
                        <li>
                            <a href="index.php#contato" class="text-success text-center">
                                <span class="glyphicon glyphicon-send"></span> CONTATO
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Computador -->
                <div class="col-sm-6 col-md-4 hidden-xs"> 
                    <h4 class="text-success">NAVEGAÇÃO</h4>
                    <ul class="nav nav-pills nav-stacked">                    
                        <li>
                            <a href="index.php#home" class="text-success">
                                <span class="glyphicon glyphicon-home"></span> HOME
                            </a>
                        </li>    
                        <li>
                            <a href="index.php#doacoes" class="text-success">
                                <span class="glyphicon glyphicon-globe"></span> DOAÇÕES
                            </a>
                        </li>
                        <li>
                            <a href="contato.php" class="text-success">
                                <span class="glyphicon glyphicon-send"></span> CONTATO
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6 col-md-4" id="contato" >
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
                                <input type="email" name="email_contato" class="form-control" placeholder="Seu e-mail" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></span>
                                <textarea name="comentarios_contato" class="form-control" rows="4" placeholder="Sua mensagem..." required></textarea>
                            </div>
                        </div>

                        <button class="btn btn-success btn-block">
                            Enviar Mensagem <span class="glyphicon glyphicon-send"></span>
                        </button>
                    </form>
                </div>

            </div> <hr style="border-color: #ccc;">

            <div class="row">
                <div class="col-xs-12 text-center">
                    <img src="imagens/icon_rodape.png" alt="Desperdício Zero" style="height: 120px; margin-bottom: 10px;">
                    <h6 style="color: #555;">
                        Developed by <strong>Ti19™</strong> 2025 &copy; Todos os direitos reservados.
                    </h6>
                </div>
            </div>

        </div> </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>