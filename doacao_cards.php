<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");

// Consulta para trazer os dados
$consulta = "SELECT * FROM vw_doacoes ORDER BY nome_alimento ASC LIMIT 4";
$lista = $conn_alimentos->query($consulta);
$totalRows = ($lista)->num_rows;
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

<body class="fundofixo">
        <div class="lista-wrapper">
            <div class="text-right" style="top: 10px; padding: 4px; margin-bottom: 10px; letter-spacing: 1px; " >
                <a href="doacao_geral.php" class="ver-todos-link">
                    Ver todos →
                </a>
            </div>
        <div class="row">
        <?php
        // Verifica se tem produtos antes de começar o loop
        if ($totalRows > 0) {
            while ($row = $lista->fetch_assoc()) 
        {;
        ?>
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="card-doacao-moderno">
                    <div class="card-img-wrapper">
                        <span class="card-badge badge-verde">
                            <?php echo $row['rotulo_tipo']; ?>
                            <!-- nome da categoria -->
                        </span>
                        <!-- coloque o php da imagem -->
                        <div class="">
                            <img src="imagens/<?php echo $row['imagem_doacao']; ?>" class="img-responsive img-rounded"
                                style="max-height: 140px; border: 1px solid #eee; padding: 5px; width: 100%;">
                        </div>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">
                            <!-- nome do alimento -->
                            <?php echo $row['nome_alimento']; ?>
                        </h4>
                        <p class="card-info">
                            <i class="fa-solid fa-weight-hanging"></i>
                            <?php echo $row['quantidade_doacao']; ?> kg
                            <br>
                            <i class="fa-solid fa-calendar-days"></i>
                            <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?>
                        </p>
                        <button type="button"
                                    class="btn btn-block shadow-sm fundoverde-padrao" style="border-radius: 15px; font-weight: 600; letter-spacing: 0.5px;" 
                                >
                                Ver detalhes
                        </button>
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

    </div>

    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>