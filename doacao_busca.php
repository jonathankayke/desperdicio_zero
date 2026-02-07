<?php
// Conexão
include("Connections/conn_alimentos.php");

// Configurações da consulta
$tabela = "vw_doacoes";
$campo_filtro = "nome_alimento";
$ordenar_por = "nome_alimento ASC";
$filtro_select = $_GET['buscar'] ?? '';

// Consulta
$consulta = "
    SELECT *
    FROM $tabela
    WHERE $campo_filtro LIKE ('%$filtro_select%')
    ORDER BY $ordenar_por
";

$lista = $conn_alimentos->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = $lista->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Doações Disponíveis</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo">
<?php include("menu_publico.php"); ?>
    <!-- Quando NÃO encontrar registros -->
    <div class="container">    
        <?php if ($totalRows == 0) { ?>
            <h2 class="breadcrumb alert-danger">
                <a href="javascript:window.history.go(-1)" class="btn btn-danger">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                Você pesquisou:
                "<strong><?php echo $filtro_select; ?></strong>"
                <br>
                Nenhuma doação encontrada no momento 😔
            </h2>
        <?php } 
            $collapseID = "detalhes_" . $row['id_doacao'];
        ?>

        <!-- Quando encontrar registros -->
        <?php if ($totalRows > 0) { ?>
            <h2 class="breadcrumb alert-success">
                <a href="javascript:window.history.go(-1)" class="btn btn-success">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                Você pesquisou:
                "<strong><?php echo $filtro_select; ?></strong>"
            </h2>

            <div class="row">

                <?php do { ?>
                    <div>
                        <div class="thumbnail card-doacao">
                            <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">

                                <div class="col-sm-2">
                                    <img src="imagens/<?php echo $row['imagem_doacao']; ?>" class="img-responsive img-rounded"
                                        style="max-height: 100px; border: 1px solid #eee; padding: 5px; width: 100%;">
                                </div>

                                <div class="col-sm-2">
                                    <h3 style="color: #c9302c; margin: 0; font-weight: bold;">
                                        <?php echo $row['nome_alimento']; ?>
                                    </h3>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <span class="label-info-custom">Tipo</span>
                                            <span class="valor-info-custom"><?php echo $row['rotulo_tipo']; ?></span>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <span class="label-info-custom">Qtd</span>
                                            <span class="valor-info-custom"><?php echo $row['quantidade_doacao']; ?></span>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <span class="label-info-custom">Validade</span>
                                            <span
                                                class="valor-info-custom"><?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2 text-right">
                                    <p style="font-size: 0.9em; margin-bottom: 10px;">
                                        <i class="glyphicon glyphicon-briefcase"></i> <?php echo $row['nome_empresa']; ?>
                                    </p>
                                    <button type="button" class="btn btn-success btn-block shadow-sm" data-toggle="collapse"
                                        data-target="#<?php echo $collapseID; ?>">
                                        Ver detalhes
                                    </button>
                                </div>

                            </div>

                            <div id="<?php echo $collapseID; ?>" class="collapse">
                                <div class="detalhes-container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p><strong><i class="glyphicon glyphicon-phone text-success"></i> Contato:</strong>
                                                <?php echo $row['contato_doacao']; ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><strong><i class="glyphicon glyphicon-map-marker text-success"></i>
                                                    Retirada:</strong>
                                                <?php echo $row['endereco_retirada']; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } while ($row = $lista->fetch_assoc()); ?>

            </div>
        <?php } ?>
    </div>                
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php mysqli_free_result($lista); ?>