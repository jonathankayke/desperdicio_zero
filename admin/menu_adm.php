<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Área Administrativa</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css"> -->
  </head>

  <body>
    <nav class="navbar navbar-custom">
        <div class="container-fluid">
            <div class="navbar-header navegacao">
            <button
                type="button"
                class="navbar-toggle collapsed"
                data-toggle="collapse"
                data-target="#defaultNavbar"
                aria-expanded="false"
            >
                <span class="sr-only">Navegação Mobile</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="indexadmin.php" class="navbar-brand">
                <img class="imagem-logo" src="../imagens/Icon_menu.png" alt="" />
            </a>
            </div>

            <div class="collapse navbar-collapse" id="defaultNavbar">
            <ul class="nav navbar-nav navbar-right borda-preta">

                <li>
                    <button type="button" class="btn btn-secondary navbar-btn disabled">
                        <span>Olá, <?php echo($_SESSION['login_usuario']); ?></span>
                    </button>
                </li>

                    <li ><a href="indexadmin.php" id="menu-admin">ADMIN</a></li>
                    <li><a href="doacao_lista.php" id="menu-doacoes">DOAÇÕES</a></li>
                    <li><a href="tipos_lista.php" id="menu-tipos">TIPOS</a></li>
                    <li><a href="usuario_lista.php" id="menu-usuarios">USUÁRIOS</a></li>
                    <li class="btn-home">
                    <a href="../indexfake.php">
                        <span class="glyphicon glyphicon-home"></span>
                    </a>
                    </li>
                      <li>
                    <a href="logout.php">
                        <span class="glyphicon glyphicon-log-out"></span>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
  </body>
</html>
