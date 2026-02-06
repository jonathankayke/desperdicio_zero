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
    <style>
    .fundo-branco {
        background-color: #fff !important;
        border-radius: 2px;
        text-align: center;
        font-size: large;
        font-weight: bold;
    }
    .verde-escuro {
        background-color: #28A745 !important;
        border-color: #28A745 !important;
        color: white;
        font-weight: bold;
        font-size: 15px;
        letter-spacing: 2px;
        padding: 14px 0;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
    .botao {
        border-radius: 5px;
        text-align: center;
        width: 100%;
    }
    .botao:hover {
        background-color: #218838 !important;
        border-color: #1E7E34 !important;
        color: white;
        font-weight: bold;
        font-size: 15px;
        letter-spacing: 2px;
        padding: 14px 0;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    }
    
    </style>
</head>
<body class="fundofixo">
<main class="container">
<h1 class="breadcrumb tituloadm text-success ">Aréa Administrativa</h1>
<div class="row">
    <!-- ADM Doações -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail doacoes-card">
            <!-- fonte awesome -->
             <i class="#"></i>
            <br>
            <div>
                <!-- botão principal -->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <div class="fundo-branco">
                        <span>DOAÇÕES</span>
                        </div>
                    
                    </div> <!-- fecha btn-group--->
                </div> <!-- fecha btn-group-justified-->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <a href="doacao_lista.php">
                            <button class="botao verde-escuro botao">Listar</button>
                        </a>
                    </div> <!-- fecha btn-group--->               
                    <div class="btn-group">
                        <a href="doacao_insere.php">
                            <button class="verde-escuro botao">Inserir</button>
                        </a>
                    </div> <!-- fecha btn-group inserir--->
                </div> <!-- fecha btn-group-justified-->
            </div> <!-- fecha alert-success-->          
        </div> <!-- fecha thumbnail-->
    </div><!-- fecha dimensionamento-->

    <!-- ADM Tipos -->
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail" style="background-color: #FCF8E3;">
            <!-- fonte awesome -->
             <i class="#"></i>
            <br>
                <!-- botão principal -->
                <div class="btn-group btn-group-justified" role="group">
                    <div class="btn-group">
                        <div class="fundo-branco">
                        <span>TIPOS</span>
                        </div>
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