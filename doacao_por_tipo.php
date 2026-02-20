<?php
include("Connections/conn_alimentos.php");

$tabela = "vw_doacoes";
$ordenar_por = "nome_alimento ASC";


if (isset($_GET['id_tipo']) && $_GET['id_tipo'] != "") {

    $id_tipo = $_GET['id_tipo'];

    $consulta = "
        SELECT *
        FROM $tabela
        WHERE id_doacao_tipo = '$id_tipo'
        ORDER BY $ordenar_por
    ";
} 
else {

    $consulta = "
        SELECT *
        FROM $tabela
        ORDER BY $ordenar_por
    ";

}
$lista     = $conn_alimentos->query($consulta);
$row       = $lista->fetch_assoc();
$totalRows = $lista->num_rows;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Doações Disponíveis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo">
<?php include('menu_publico.php')?>
<div class="container">
        <?php if ($totalRows == 0) { ?>
            <h2 class="breadcrumb alert-success">
                <a href="index.php" class="btn btn-success">
                    Voltar
                </a>
                Nenhuma doação encontrada para este tipo.
            </h2>
        <?php } ?>

        <?php if ($totalRows > 0) { ?>
            <h2 class="breadcrumb alert-success">
                <a href="index.php" class="btn btn-success">
                    Voltar
                </a>
                <strong><?php echo $row['rotulo_tipo']; ?></strong>
            </h2>

            <div class="row">
                <?php do { ?>
                    <div class="lista-wrapper borda-verde">
                    <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">

                        <div class="col-sm-2">
                            <img src="imagens/<?php echo $row['imagem_doacao']; ?>" class="img-responsive img-rounded"
                                style="max-height: 100px; border: 1px solid #eee; padding: 5px; width: 100%;">
                        </div>

                        <div class="col-sm-2">
                            <h3 style="color: #2cc960ff; margin: 0; font-weight: bold;">
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
                            <a href="doacao_detalhe.php?id_doacao=<?php echo $row['id_doacao']; ?>">   
                            <button type="button"
                                        class="btn btn-block shadow-sm fundoverde-padrao" style="border-radius: 15px; font-weight: 600; letter-spacing: 0.5px;" 
                                    >
                                    Ver detalhes
                            </button>
                        </a>
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
