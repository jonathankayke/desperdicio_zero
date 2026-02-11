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
       <div class="row">

    <div class="col-xs-12 col-sm-6 col-md-3">
        <div class="card-doacao-moderno">
            <div class="card-img-wrapper">
                <span class="card-badge badge-verde"> 
                    <?php echo $row['categoria']; ?>
                    <!-- nome da categoria -->
                </span>
                <!-- coloque o php da imagem -->
                <!-- <img src="https://images.unsplash.com/photo-1560806887-1e4cd0b6cbd6?auto=format&fit=crop&w=500&q=60" alt="Maçã"> -->
            </div>
            <div class="card-content">
                <h4 class="card-title">
                    <!-- nome do alimento -->
                    <?php echo $row['nome_alimento']; ?>
                </h4>
                <p class="card-info">
                    <i class="fa-solid fa-weight-hanging"></i>
                     <?php echo $row['quantidade']; ?> kg
                     <br>
                    <i class="fa-solid fa-calendar-days"></i>
                    <?php echo date('d/m/Y', strtotime($row['data_validade'])); ?>
                </p>
                <div class="card-footer-custom">
                    <div class="text-center">
                    <span class="status-dot status-livre"></span> Disponível
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    </div>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>    
</body>
</html>