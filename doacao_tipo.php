<?php
// Conexão com o banco desperdicio_zero
include("Connections/conn_alimentos.php");


// Configurações da consulta
$tabela = "vw_doacoes";
$ordenar_por = "nome_alimento ASC";

// Consulta filtrando pelo tipo de doação
$consulta = "
    SELECT *
    FROM $tabela
    WHERE id_doacao_tipo = ?
    ORDER BY $ordenar_por
";

// Preparar statement para evitar SQL injection
$stmt = $conn_alimentos->prepare($consulta);
$stmt->bind_param("i", $id_tipo);
$stmt->execute();
$resultado = $stmt->get_result();

$totalRows = $resultado->num_rows;
$row = null;
if ($totalRows > 0) {
    $row = $resultado->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos por Tipo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo">
    <!-- MENU -->
    <?php include('menu_publico.php'); ?>
    <main class="container">

        <h2 class="breadcrumb alert-danger">
            <a href="javascript:window.history.go(-1)" class="btn btn-danger">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            Produtos por Tipo
        </h2>

        <?php if ($totalRows == 0): ?>
            <div class="alert-warning" role="alert">
                Nenhum produto encontrado para este tipo.
            </div>
        <?php else: ?>
            <div class="row">
                <?php do {
                    // ID para collapse dos detalhes
                    $collapseID = "detalhes_" . $row['id_doacao'];
                ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">

                                <div class="col-sm-2">
                                    <img src="imagens/<?php echo htmlspecialchars($row['imagem_doacao']); ?>"
                                         class="img-responsive img-rounded"
                                         style="max-height: 100px; border: 1px solid #eee; padding: 5px; width: 100%;">
                                </div>

                                <div class="col-sm-2 text-success">
                                    <h3 style="margin: 0; font-weight: bold;">
                                        <?php echo htmlspecialchars($row['nome_alimento']); ?>
                                    </h3>
                                </div>

                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <span class="label-info-custom">Tipo</span>
                                            <span class="valor-info-custom"><?php echo htmlspecialchars($row['rotulo_tipo']); ?></span>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <span class="label-info-custom">Qtd</span>
                                            <span class="valor-info-custom"><?php echo htmlspecialchars($row['quantidade_doacao']); ?></span>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <span class="label-info-custom">Validade</span>
                                            <span class="valor-info-custom">
                                                <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-2 text-right">
                                    <p style="font-size: 0.9em; margin-bottom: 10px;">
                                        <i class="glyphicon glyphicon-briefcase"></i>
                                        <?php echo htmlspecialchars($row['nome_empresa']); ?>
                                    </p>
                                    <button type="button" class="btn btn-success btn-block shadow-sm"
                                            data-toggle="collapse"
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
                                                <?php echo htmlspecialchars($row['contato_doacao']); ?></p>
                                        </div>
                                        <div class="col-sm-6">
                                            <p><strong><i class="glyphicon glyphicon-map-marker text-success"></i> Retirada:</strong>
                                                <?php echo htmlspecialchars($row['endereco_retirada']); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } while ($row = $resultado->fetch_assoc()); ?>
            </div>
        <?php endif; ?>

        <!-- RODAPÉ -->
        <footer>
            <?php include('rodape.php'); ?>
            <a name="contato"></a>
        </footer>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$resultado->free();
?>