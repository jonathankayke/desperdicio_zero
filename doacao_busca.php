<?php
// Conexão
include("Connections/conn_alimentos.php");

// Configurações da consulta
$tabela         = "vw_doacoes";
$campo_filtro   = "nome_alimento";
$ordenar_por    = "nome_alimento ASC";
$filtro_select  = $_GET['buscar'] ?? '';

// Consulta
$consulta = "
    SELECT *
    FROM $tabela
    WHERE $campo_filtro LIKE ('%$filtro_select%')
    ORDER BY $ordenar_por
";

$lista     = $conn_alimentos->query($consulta);
$row       = $lista->fetch_assoc();
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

<body class="container">

<!-- Quando NÃO encontrar registros -->
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
<?php } ?>

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
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">

            <img 
                src="imagens/<?php echo $row['imagem_doacao']; ?>" 
                class="img-responsive img-rounded"
                style="height: 20em;"
                alt="Imagem da doação"
            >

            <div class="caption text-right">
                <h3 class="text-danger">
                    <strong><?php echo $row['nome_alimento']; ?></strong>
                </h3>

                <p class="text-warning">
                    <strong><?php echo $row['rotulo_tipo']; ?></strong>
                </p>

                <p class="text-left">
                    Empresa: <?php echo $row['nome_empresa']; ?><br>
                    Quantidade: <?php echo $row['quantidade_doacao']; ?><br>
                    Validade: <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?>
                </p>

                <p>
                    <a 
                        href="doacao_detalhe.php?id_doacao=<?php echo $row['id_doacao']; ?>" 
                        class="btn btn-danger"
                    >
                        <span class="hidden-xs">Ver detalhes</span>
                        <span class="visible-xs glyphicon glyphicon-eye-open"></span>
                    </a>
                </p>
            </div>

        </div>
    </div>
<?php } while ($row = $lista->fetch_assoc()); ?>

</div>
<?php } ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php mysqli_free_result($lista); ?>
