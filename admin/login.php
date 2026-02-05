<?php 
include("../Connections/conn_produtos.php");
if ($_POST){
    mysqli_select_db($conn_produtos,$database_conn);

    // verificar senha e ousuario recebidos
    $login_usuario=$_POST["login_usuario"];
    $senha_usuario=$_POST["senha_usuario"];
    $verificaSQL = "SELECT * FROM tbusuarios WHERE login_usuario = '$login_usuario' AND senha_usuario = '$senha_usuario' ";

    // carregar dados e verificar linhas
    $lista_session = mysqli_query($conn_produtos,$verificaSQL);
    $row_session = $lista_session->fetch_assoc();
    $totalRows_session = mysqli_num_rows($lista_session);
    
    if (!issset($_SESSION)) {
        $sessao_antiga = session_name('chuletaaa');
        session_start();
        $session_name_new = session_name(); //recupero o nome da atual sessão
    };

    // carregar informações na sessão
    if($totalRows_session > 0){
        $_SESSION['login_usuario'] = $login_usuario;
        $_SESSION['nivel_usuario'] = $row_session['nivel_usuario'];
        $_SESSION['nome_da_sessao'] = session_name();
       echo "<script>window.open('index.php','_self')</script>";
    } else {
        // mensagem de erro
        echo "<script>window.open('invasor.php','_self')</script>";
    };
};

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Refresh" content="1500;URL=../index.php" >
    <title>Modelo</title>
    <script src="https://kit.fontawesome.com/2495680ceb.js" crossorigin="anonymous"></script>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<main class="container">
<section>
    <article>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                <h1 class="breadcrumb text-info text-center">Faça seu login</h1>
                <div class="thumbnail">
                    <p class="text-info text-center" role="alert">
                        <i class="fas fa-users fa-10x"></i>
                    </p>
                    <br>
                    <div class="alert alert-info" role="alert">
                        <form action="login.php" name="form_login" id="form_login" method="post" enctype="multipart/form-data">
                            <label for="login_usuario">Login:</label>
                            <p class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user text-info" aria-hidden="true"></span>
                                </span>
                                <input type="text" name="login_usuario" id="login_usuario" class="form-control" autofocus required placeholder="Digite seu login." autocomplete="off">
                            </p>
                            <label for="senha_usuario">Senha:</label>
                            <p class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-qrcode text-info" aria-hidden="true"></span>
                                </span>
                                <input type="password" name="senha_usuario" id="senha_usuario" class="form-control" required placeholder="Digite sua senha.">
                            </p>
                            <p class="text-right">
                                <input type="submit" value="Entrar" class="btn btn-primary">
                            </p>
                        </form>
                        <p class="text-center">
                            <small>
                                <br>
                                Caso não faça um escolha em 15 segundos será redirecionado automaticamente para página inicial.
                            </small>
                        </p>                       
                    </div> <!-- fecha alert -->
                </div> <!-- fecha thumbnail -->
            </div> <!-- fecha dimensionamento -->
        </div> <!-- fecha row -->
    </article>
</section>
</main>
<!-- Link arquivos bootstrap script js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>