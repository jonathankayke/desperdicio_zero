<?php
// Incluir o arquivo para fazer a conexão e buscar os tipos para o menu
include("Connections/conn_alimentos.php");

$tabela_menu = "tbtipos";
$ordernar_menu = "rotulo_tipo";
$consulta_menu = "
                    SELECT  *
                    FROM    " . $tabela_menu . "\n                    ORDER BY " . $ordernar_menu . ";
                    ";
$lista_menu = $conn_alimentos->query($consulta_menu);
$row_menu = $lista_menu->fetch_assoc();
$totalRows_menu = ($lista_menu)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
    <!-- <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css"> -->
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header navegacao">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar" aria-expanded="false">
                    <span class="sr-only">Navegação Mobile</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="admin2.php" class="navbar-brand">
                    <img src="imagens/Icon_menu.png" alt="">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="defaultNavbar">
                <ul class="nav navbar-nav navbar-right blacks">
                    <li><a href="#doacoes">DOAÇÕES</a></li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            TIPOS
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="doacao_por_tipo.php">TODOS</a></li>
                            <?php do { ?>
                                <li>
                                    <a href="doacao_por_tipo.php?id_tipo=<?php echo $row_menu['id_tipo']; ?>">
                                        <?php echo $row_menu['rotulo_tipo']; ?>
                                    </a>
                                </li>
                            <?php } while ($row_menu = $lista_menu->fetch_assoc()); ?>
                        </ul>
                    </li>

                    <li><a href="#">USUÁRIOS</a></li>
                    <li class="active">
                        <a href="admin/admin.php">
                            <span class="glyphicon glyphicon-user"></span>
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
<?php mysqli_free_result($lista_menu); ?>