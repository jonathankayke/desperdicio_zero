<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");
 
// Consulta para trazer os dados
$tabela_menu    =   "tbtipos";
$ordernar_menu  =   "rotulo_tipo";
$consulta_menu  =   "
                    SELECT  *
                    FROM    ".$tabela_menu."
                    ORDER BY ".$ordernar_menu.";
                    ";
$lista_menu     =   $conn_alimentos->query($consulta_menu);
$row_menu       =   $lista_menu->fetch_assoc();
$totalRows_menu =   ($lista_menu)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Pública</title>
    <!-- Link CSS do Bootstrap -->
     <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body>
    <nav class="navbar navegacao">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">
                    <img src="imagens/Icon_menu.png" alt="">
                </a>
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
            </div>
   
            <div class="collapse navbar-collapse" id="defaultNavbar"> <!-- barra de navegação -->
        <ul class="nav navbar-nav navbar-right">
            <li class="active">
                <a href="index.php">
                    <span class="glyphicon glyphicon-home"></span>
                </a>
            </li>
            <li><a href="index.php#MaisVendidos">Mais vendidos</a></li>
            <li><a href="index.php#produtos">PRODUTOS</a></li>
            <li class="dropdown">
                <a
                    href="doacao_tipos.php"
                    class="dropdown-toggle"
                    data-toggle="dropdown"
                    role="button"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    TIPOS
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="doacao_tipos.php">
                            TODOS
                        </a>
                    </li>
                    <?php do{ ?> <!-- abre estrutura de repetição -->
                        <li>
                            <a href="doacao_por_tipos.php?id_tipo=<?php echo $row_menu['id_tipo']; ?>">
                                <?php echo $row_menu['rotulo_tipo']; ?>
                            </a>
                        </li>
                    <?php } while ($row_menu=$lista_menu->fetch_assoc()); ?>
                    <!-- Fecha estrutura de repetição -->
                </ul>
            </li> <!-- fecha dropdown -->
            <li><a href="index.php#contato">CONTATO</a></li>
            <!-- Form Busca -->
            <form
                action="doacao_busca.php"
                method="get"
                name="form_busca"
                id="form_busca"
                class="navbar-form navbar-left"
                role="search"
            >
                <div class="form-group">
                    <div class="input-group">
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Busca Doação"
                            name="buscar"
                            id="buscar"
                            size="9"
                            required
                        >
                        <span class="input-group-btn">
                            <button
                                type="submit"
                                class="btn btn-default"
                            >
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div> <!-- fecha input-group -->
                </div> <!-- fecha form-group -->
            </form>
            <li class="active">
                <a href="admin/index.php">
                    <span class="glyphicon glyphicon-user"></span>
                </a>
            </li>
        </ul>
    </div><!-- fecha barra de navegação -->
</div>
 
        </div>
    </nav>
 
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php mysqli_free_result($lista_menu); ?>