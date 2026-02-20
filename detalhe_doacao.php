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
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico-->
    <link rel="stylesheet" href="css/meu_estilo.css"> 
</head>
<body>
<main class="container">
    <div class="row panel-footer" style="background-color: rgba(255, 255, 255, 0.6);" > <!-- abre painel do rodapé -->
    <!-- Area de localização -->
    <div class="col-sm-6 col-md-4">
        <div class="col-sm-2">
            <img src="imagens/<?php echo $row['imagem_doacao']; ?>" class="img-responsive img-rounded"
                style="max-height: 100px; border: 1px solid #eee; padding: 5px; width: 100%;">
        </div>
    </div> <!-- fecha dimencionamento/area -->

    <!-- Area de Navegação -->
    <div class="col-sm-6 col-md-4">
        <div class="panel-footer" style="background:none; margin-top: 40px; ">
            <h4>LINKS</h4>
            <ul class="nav nav-pills nav-stacked">
                <li>
                    <span class="label-info-custom">Tipo</span>
                    <span class="valor-info-custom"><?php echo $row['rotulo_tipo']; ?></span>
                </li>
                <li>
                    <a href="index.php#doacoes" class="text-success">
                        <span class="glyphicon glyphicon-globe">&nbsp;DOAÇÕES</span>
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
    <div class="col-sm-6 col-md-4" id="contato">
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
                            name="comentarios_contato" 
                            id="comentarios_contato"
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
</main>
<!-- Link arquivos Bootstrap js --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>   
</body>
</html>
<?php mysqli_free_result($lista); ?>                 