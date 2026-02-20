<?php
// Verifica se a sessão já foi iniciada, se não, ele inicia.
if(!isset($_SESSION)){
    session_start();
}

// Seu include do banco de dados...
include("Connections/conn_alimentos.php");
// ... resto do seu código PHP
$tabela_menu = "tbtipos";
$ordernar_menu = "rotulo_tipo";
$consulta_menu = "SELECT * FROM " . $tabela_menu . " ORDER BY " . $ordernar_menu . ";";
$lista_menu = $conn_alimentos->query($consulta_menu);
$row_menu = $lista_menu->fetch_assoc();
$totalRows_menu = ($lista_menu)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desperdício Zero</title>
</head>

<body>

    <nav class="navbar navbar-custom">
        <div class="container-fluid">

            <div class="navbar-header navegacao">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#defaultNavbar" aria-expanded="false">
                    <span class="sr-only">Navegação Mobile</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" class="navbar-brand">
                    <img src="imagens/Icon_menu.png" alt="Logo" class="imagem-logo">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="defaultNavbar">
                <ul class="nav navbar-nav navbar-right">

                    <li><a href="doacao_geral.php">DOAÇÕES</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                            aria-expanded="false">
                            TIPOS <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="doacao_tipo.php">TODOS</a></li>
                            <?php do { ?>
                                <li>
                                    <a href="doacao_por_tipo.php?id_tipo=<?php echo $row_menu['id_tipo']; ?>">
                                        <?php echo $row_menu['rotulo_tipo']; ?>
                                    </a>
                                </li>
                            <?php } while ($row_menu = $lista_menu->fetch_assoc()); ?>
                        </ul>
                    </li>

                    <li><a href="sobre_nos.php">SOBRE NÓS</a></li>
                    <li><a href="#contato">CONTATO</a></li>
                    

                    <li class="li-busca">
                        <form action="doacao_busca.php" method="get" name="form_busca" class="navbar-form form_busca"
                            role="search">
                            <div class="input-group input-busca-moderno">
                                <input type="text" class="form-control" placeholder="Pesquisar..." name="buscar"
                                    id="buscar" required>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </span>
                            </div>
                        </form>
                    </li>

                    <li class="btn-home">
                        <a href="admin/index.php" title="Acesso Administrativo">
                            <span class="glyphicon glyphicon-user"></span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</body>

</html>
<?php mysqli_free_result($lista_menu); ?>