<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela         =   "vw_doacoes";
$campo_filtro   =   "rotulo_tipo";
$ordenar_por    =   "nome_alimento ASC";
$filtro_select  =   "Não";
$consulta =         "
                    SELECT *
                    FROM vw_doacoes
                    ORDER BY nome_alimento ASC
                    ";
$lista      =   $conn_alimentos->query($consulta);
$row        =   $lista->fetch_assoc();
$totalRows  =   ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modelo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body class="container">
<h2 class="breadcrumb alert-success">Doações</h2>
<div class="row">
    <?php while ($row = $lista->fetch_assoc()) { ?>
    <div class="thumbnail">
        <div class="row">

            <div class="col-sm-2 text-justify align-items: center">
                <img 
                    src="imagens/<?php echo $row['imagem_doacao']; ?>" 
                    class="img-responsive img-rounded"
                    style="max-height: 100px; margin: center;"
                >
            </div>
     
            <div class="col-sm-2">
                <h4 class="text-danger text-center text-justify">
                    <strong><?php echo $row['nome_alimento']; ?></strong>
                </h4>
            </div>    
            <div class="col-sm-2">    
                <p><strong>Tipo:</strong> <?php echo $row['rotulo_tipo']; ?></p>
            </div>
            <div class="col-sm-2">
                <p><strong>Quantidade:</strong> <?php echo $row['quantidade_doacao']; ?></p>
            </div>
            <div class="col-sm-2">
                <p>
                    <strong>Validade:</strong>
                    <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?>
                </p>
            </div>
            <div class="col-sm-2">     
                <p><strong>Empresa:</strong> <?php echo $row['nome_empresa']; ?></p>

                <a 
                    href="nome_alimento.php?id_doacao=<?php echo $row['id_doacao']; ?>" 
                    class="btn btn-success btn-sm"
                >
                    Ver detalhes
                </a>
            </div>

        </div>
    </div>
<?php } ?>
</div>

<!-- Link arquivos Bootstrap js -->  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
</body>
</html>
<?php mysqli_free_result($lista); ?>