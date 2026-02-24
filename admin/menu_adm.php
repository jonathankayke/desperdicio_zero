
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Área Administrativa</title>
    
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body>
    <nav class="navbar navbar-custom">
        <div class="container-fluid">

            <div class="navbar-header navegacao">
                
                <a href="index.php" class="navbar-brand">
                    <img src="../imagens/Icon_menu.png" alt="Logo" class="imagem-logo">
                </a>

                <div class="navbar-toggle">
                    <a href="../index.php" title="Acesso Administrativo"
                        style="color: #ffffffff; font-size: 22px; margin-right: 15px; text-decoration: none;">
                        <span class="glyphicon glyphicon-home"></span>
                    </a>

                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#defaultNavbar" aria-expanded="false" style="margin: 0; float: none;">
                        <span class="sr-only">Navegação Mobile</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>

            <div class="collapse navbar-collapse" id="defaultNavbar">
                <ul class="nav navbar-nav navbar-right borda-preta">

                    <li>
                        <button type="button" class="btn btn-secondary navbar-btn disabled">
                            <span>Olá, <?php echo isset($_SESSION['login_usuario']) ? $_SESSION['login_usuario'] : 'Admin'; ?></span>
                        </button>
                    </li>

                    <li><a href="index.php" id="menu-admin">ADMIN</a></li>
                    <li><a href="doacao_lista.php" id="menu-doacoes">DOAÇÕES</a></li>
                    <li><a href="tipos_lista.php" id="menu-tipos">TIPOS</a></li>
                    <li><a href="usuario_lista.php" id="menu-usuarios">USUÁRIOS</a></li>
                    <li class="btn-home">
                    <a href="../index.php">
                        <span class ="glyphicon glyphicon-home"></span>
                    </a>
                    </li>
                    <li>
                        <a href="logout.php" title="Sair do Sistema">
                            <span class="glyphicon glyphicon-log-out"></span> Sair
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>

</html>