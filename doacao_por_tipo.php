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
            <h2 class="breadcrumb alert-danger">
                <a href="javascript:window.history.go(-1)" class="btn btn-danger">
                    Voltar
                </a>
                Nenhuma doação encontrada para este tipo.
            </h2>
        <?php } ?>

        <?php if ($totalRows > 0) { ?>
            <h2 class="breadcrumb alert-success">
                <a href="javascript:window.history.go(-1)" class="btn btn-success">
                    Voltar
                </a>
                <strong><?php echo $row['rotulo_tipo']; ?></strong>
            </h2>

            <div class="row">
                <?php do { ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">

                            <img
                                src="imagens/<?php echo $row['imagem_doacao']; ?>"
                                class="img-responsive img-rounded"
                                style="height: 200px; width:100%; object-fit:cover;"
                                alt="Imagem da doação"
                            >

                            <div class="caption">
                                <h4 class="text-danger">
                                    <strong><?php echo $row['nome_alimento']; ?></strong>
                                </h4>

                                <p>
                                    <strong>Tipo:</strong>
                                    <?php echo $row['rotulo_tipo']; ?>
                                </p>

                                <p>
                                    <strong>Empresa:</strong>
                                    <?php echo $row['nome_empresa']; ?>
                                </p>

                                <p>
                                    <strong>Quantidade:</strong>
                                    <?php echo $row['quantidade_doacao']; ?>
                                </p>

                                <p>
                                    <strong>Validade:</strong>
                                    <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?>
                                </p>

                                <p>
                                    <strong>Endereço:</strong>
                                    <?php echo $row['endereco_retirada']; ?>
                                </p>

                                <p>
                                    <strong>Contato:</strong>
                                    <?php echo $row['contato_doacao']; ?>
                                </p>
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
