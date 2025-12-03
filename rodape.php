<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico-->
    <link rel="stylesheet" href="css/meu_estilo.css"> 
</head>
<body class="fundofixo">
<div class="row panel-footer" style="background-color: rgba(255, 255, 255, 0.6);" > <!-- abre painel do rodapé -->
<!-- Area de localização -->
<div class="col-sm-6 col-md-4">
    <div class="panel-footer rodape" style="background:none; "> <!-- fecha panel footer -->
        <img src="imagens/icon_rodape.png" alt="" style="height: 140px; margin-top: -20px;">
        <br>
        <address>
            <i>Rua Dom Joaquim, 495 - Centro - Itapetininga - SP - CEP 18200-000</i>
            <br>
            <span class="glyphicon glyphicon-phone-alt"></span>
            &nbsp;Fone: (15) 4002 8922
            <br>
            <span class="glyphicon glyphicon-envelope"></span>
            &nbsp;E-mail:
            <a 
                href=""
            >
                contato@desperdiciozero.com.br
            </a>
            <div class="embed-responsive embed-responsive-16by9"> <!-- mapa -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3656.352740323464!2d-48.
                05545982398403!3d-23.591679162707983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c5cc93b46246ed%3A0x6ec0870ce87bb6fd!2sSenac%20Itapetininga!5e0!3m2!1spt-BR!2sbr!4v1761610477160!5m2!1spt-BR!2sbr" 
                style="border:0; height: 240px; " allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div> <!-- fecha mapa -->
        </address>
    </div> <!-- fecha panel footer -->
</div> <!-- fecha dimencionamento/area -->

<!-- Area de Navegação -->
<div class="col-sm-6 col-md-4">
    <div class="panel-footer" style="background:none; margin-top: 40px; ">
        <h4>LINKS</h4>
        <ul class="nav nav-pills nav-stacked">
            <li>
                <a href="index.php#home" class="text-success">
                    <span class="glyphicon glyphicon-home">&nbsp;HOME</span>
                </a>
            </li>
            <li>
                <a href="index.php#destaques" class="text-success">
                    <span class="glyphicon glyphicon-fire">&nbsp;DESTAQUES</span>
                </a>
            </li>
            <li>
                <a href="index.php#doaçoes" class="text-success">
                    <span class="glyphicon glyphicon-globe">&nbsp;DOAÇÕES</span>
                </a>
            </li>
            <li>
                <a href="produtos_tipos.php" class="text-success">
                    <span class="glyphicon glyphicon-tasks">&nbsp;TIPOS</span>
                </a>
            </li>
            <li>
                <a href="index.php#contato" class="text-success">
                    <span class="glyphicon glyphicon-send">&nbsp;CONTATO</span>
                </a>
            </li>
            <li>
                <a href="admin/index.php" class="text-success">
                    <span class="glyphicon glyphicon-user">&nbsp;ADMINISTRAÇÂO</span>
                </a>
            </li>
        </ul>
    </div>
</div> <!-- fecha dimencionamento/area -->

<!-- Area de Contato -->
<div class="col-sm-6 col-md-4">
    <div class="panel-footer" style="background:none; margin-top: 40px; ">
        <h4>CONTATO</h4>
        <form 
            action="rodape_contato_envia.php"
            name="form_contato"
            id="form_contato"
            method="post"
        >
            <!-- input group HOME -->
            <p>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">
                        <span class="glyphicon glyphicon-user"></span>
                    </span>
                    <input 
                        type="text"
                        name="nome_contato"
                        id="nome_contato"
                        placeholder="Digite seu nome"
                        aria-describedby="basic-addon1"
                        required
                        class="form-control"
                    >
                </div>
            </p>

            <!-- construa o input group email use glyphicon-envelope -->
            <p>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">
                        <span class="glyphicon glyphicon-envelope"></span>
                    </span>
                    <input 
                        type="email"
                        name="email_contato"
                        id="email_contato"
                        placeholder="Digite seu Email"
                        aria-describedby="basic-addon2"
                        required
                        class="form-control"
                    >
                </div>
            </p>
            <!-- construa o textarea comentarios use glyphicon-pencil -->
            <p>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </span>
                    <textarea 
                        name="comentario_contato" 
                        id="comentario_contato"
                        placeholder="Comentários, dúvidas e/ou sugestões."
                        cols="30"
                        rows="8"
                        aria-describedby="basic-addon3"
                        class="form-control"
                    ></textarea>
                </div>
            </p>
            <!-- construa o botão enviar use glyphicon-send -->
            <p>      
                <button class="btn btn-success btn-block" aria-label="Enviar">
                    Enviar
                    <span class="glyphicon glyphicon-send"></span>
                </button> 
            </p>                    
        </form>
    </div>
</div> <!-- fecha dimencionamento/area -->

</div> <!-- fecha painel principal do rodapé -->

<!-- Link arquivos Bootstrap js --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>   
</body>
</html>                 