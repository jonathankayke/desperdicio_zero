<?php
// Conexão com o banco desperdicio_zero
include("Connections/conn_alimentos.php");

// Configurações da consulta
$tabela = "vw_doacoes";
$ordenar_por = "nome_alimento ASC";
$campo_filtro = "id_doacao";
$filtro_select = $_GET['id_doacao'];

$consulta = "
                    SELECT *
                    FROM " . $tabela . "
                    WHERE " . $campo_filtro . " = '" . $filtro_select . "'
                    ORDER BY " . $ordenar_por . ";
                    ";

$lista = $conn_alimentos->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = $lista->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico-->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo">

    <div class="container" style="margin-top:150px;">

        <?php if ($totalRows > 0) { ?>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="lista-wrapper">
                        <div class="text-left" style="top: 10px; padding: 4px; margin-bottom: 10px; letter-spacing: 1px;">
                            <a href="#" onclick="history.back(); return false;" class="ver-todos-link">
                                Voltar
                            </a>
                        </div>
                        <div class="row">

                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">

                                <div class="row">

                                    <!-- IMAGEM -->
                                    <div class="col-md-6 text-center">
                                        <img src="imagens/<?php echo $row['imagem_doacao']; ?>"
                                            class="img-responsive img-rounded" style="max-height:350px; margin-top:35px;">
                                    </div>

                                    <!-- INFORMAÇÕES -->
                                    <div class="col-md-6">

                                        <span class="label label-success">
                                            <?php echo $row['rotulo_tipo']; ?>
                                        </span>

                                        <h3 class="text-danger">
                                            <strong><?php echo $row['nome_alimento']; ?></strong>
                                        </h3>

                                        <hr>

                                        <p><strong>Empresa:</strong><br>
                                            <?php echo $row['nome_empresa']; ?></p>

                                        <p><strong>Quantidade:</strong><br>
                                            <?php echo $row['quantidade_doacao']; ?></p>

                                        <p><strong>Validade:</strong><br>
                                            <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?></p>

                                        <p><strong>Endereço:</strong><br>
                                            <?php echo $row['endereco_retirada']; ?></p>

                                        <p><strong>Contato:</strong><br>
                                            <?php echo $row['contato_doacao']; ?></p>

                                        <br>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            <?php } else { ?>

                <div class="alert alert-danger text-center">
                    Doação não encontrada.
                </div>

            <?php } ?>

        </div>
        <!-- Link arquivos Bootstrap js -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php mysqli_free_result($lista); ?>