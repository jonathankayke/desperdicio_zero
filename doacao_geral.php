<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");

// Consulta para trazer os dados
$consulta = "SELECT * FROM vw_doacoes ORDER BY nome_alimento ASC";
$lista = $conn_alimentos->query($consulta);
$totalRows = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo">
<?php include('menu_publico.php')?>
    <!-- Doaçoes -->
    <h1 class=" text-success text-center">Lista de Doações</h1>

    <div class="container">
        <?php
        // Verifica se tem produtos antes de começar o loop
        if ($totalRows > 0) {
            while ($row = $lista->fetch_assoc()) {
                // Gerar um ID único para cada item da lista
                $collapseID = "detalhes_" . $row['id_doacao'];
        ?>

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
                            <button type="button"
                                    class="btn btn-success btn-block shadow-sm"
                                    data-toggle="collapse"
                                    data-target="#<?php echo $collapseID; ?>"
                                >
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
                                    <p><strong><i class="glyphicon glyphicon-map-marker text-success"></i> Retirada:</strong>
                                        <?php echo $row['endereco_retirada']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
            } // Fim do While
        } else {
            ?>
            <div class="alert alert-warning">Nenhuma doação encontrada.</div>
        <?php } ?>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
    $('.doacao-click').on('click', function (e) {

        // se o clique foi em um botão ou dentro dele, não faz nada
        if ($(e.target).closest('button').length) {
            return;
        }

        window.location.href = $(this).data('link');
    });
    </script>

</body>

</html>
<?php mysqli_free_result($lista); ?>