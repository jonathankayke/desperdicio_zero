<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");

// Consulta para trazer os dados
$consulta = "SELECT * FROM vw_doacoes ORDER BY nome_alimento ASC";
$lista    = $conn_alimentos->query($consulta);

// Retirei o '$row = ...' daqui para não pular o primeiro item da lista.
// O 'fetch_assoc' será feito direto no while lá embaixo.
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
<body class="container">
    
    <h2 class="breadcrumb alert-success">Doações</h2>
    
    <div class="row">
        <?php 
        // Verifica se tem produtos antes de começar o loop
        if($totalRows > 0) {
            while ($row = $lista->fetch_assoc()) { 
        ?>
        
        <div class="thumbnail">
            <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">

                <div class="col-sm-2">
                    <img 
                        src="imagens/<?php echo $row['imagem_doacao']; ?>" 
                        class="img-responsive img-rounded"
                        style="max-height: 100px; margin: 0 auto; display: block;" 
                    >
                </div>
         
                <div class="col-sm-2">
                    <h4 class="text-danger text-center">
                        <strong><?php echo $row['nome_alimento']; ?></strong>
                    </h4>
                </div>    

                <div class="col-sm-2 text-center">    
                    <p><strong>Tipo:</strong><br><?php echo $row['rotulo_tipo']; ?></p>
                </div>

                <div class="col-sm-2 text-center">
                    <p><strong>Quantidade:</strong><br><?php echo $row['quantidade_doacao']; ?></p>
                </div>

                <div class="col-sm-2 text-center">
                    <p>
                        <strong>Validade:</strong><br>
                        <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?>
                    </p>
                </div>

                <div class="col-sm-2 text-center">    
                    <p><strong>Empresa:</strong><br><?php echo $row['nome_empresa']; ?></p>

                    <a 
                        href="nome_alimento.php?id_doacao=<?php echo $row['id_doacao']; ?>" 
                        class="btn btn-success btn-sm"
                    >
                        Ver detalhes
                    </a>
                </div>

            </div> </div> <?php 
            } // Fim do While
        } else { 
        ?>
            <div class="alert alert-warning">Nenhuma doação encontrada.</div>
        <?php } ?>
    </div> <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
</body>
</html>
<?php mysqli_free_result($lista); ?>