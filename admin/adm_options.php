<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<main class="container">
<h1 class="breadcrumb tituloadm text-success ">Aréa Administrativa</h1>
<div class="row">
    <!-- ADM Doações -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail doacoes-card">
        <img src="../imagens/icon_doacoes.png" alt="">
            <br>
            <div>
                <!-- botão principal -->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                            DOAÇÕES
                        </button>
                    </div> <!-- fecha btn-group--->
                </div> <!-- fecha btn-group-justified-->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <a href="doacao_lista.php">
                            <button class="btn btn-success">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group--->               
                    <div class="btn-group">
                        <a href="doacao_insere.php">
                            <button class="btn btn-success">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group inserir--->
                </div> <!-- fecha btn-group-justified-->
            </div> <!-- fecha alert-success-->          
        </div> <!-- fecha thumbnail-->
    </div><!-- fecha dimensionamento-->

    <!-- ADM Tipos -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail alert-warning">
            <img src="../imagens/icon_tipos.png" alt="">
            <br>
            <div class="alert-warning">
                <!-- botão principal -->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                            TIPOS
                        </button>
                    </div> <!-- fecha btn-group--->
                </div> <!-- fecha btn-group-justified-->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <a href="tipos_lista.php">
                            <button class="btn btn-warning">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group--->               
                    <div class="btn-group">
                        <a href="tipos_insere.php">
                            <button class="btn btn-warning">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group inserir--->
                </div> <!-- fecha btn-group-justified-->
            </div> <!-- fecha alert-warning-->
        </div> <!-- fecha thumbnail-->
    </div><!-- fecha dimensionamento-->

    <!-- ADM Usuarios -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail alert-info">
            <img src="../imagens/icon_usuarios.png" alt="">
            <br>
            <div class="alert-info">
                <!-- botão principal -->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <button 
                            class="btn btn-default disabled"
                            style="cursor: default;"
                        >
                            USUARIOS
                        </button>
                    </div> <!-- fecha btn-group--->
                </div> <!-- fecha btn-group-justified-->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <a href="usuario_lista.php">
                            <button class="btn btn-info">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group--->               
                    <div class="btn-group">
                        <a href="usuario_insere.php">
                            <button class="btn btn-info">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group inserir--->
                </div> <!-- fecha btn-group-justified-->
            </div> <!-- fecha alert-info-->
        </div> <!-- fecha thumbnail-->
    </div><!-- fecha dimensionamento-->

</div> <!-- fecha row -->    
</main>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>