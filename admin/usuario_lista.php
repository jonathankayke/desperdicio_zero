<?php
include ('../Connections/conn_alimentos.php');

$consulta   =   "
                SELECT      *
                FROM        tbusuarios
                ORDER BY    nome_usuario ASC;
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
    <title>Lista de Usuários</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="fundofixo">
    <main class="container">
        <h1 class="breadcrumb alert-success text-center">Lista de Usuários</h1>
        <div class="btn btn-success disabled">
            Total de Usuários:
        </div>
        <table class="table table-hover table-condensed tbopacidade fontelista">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Senha</th> <!-- ocultar -->
                    <th>Tipo</th>
                    <th>Telefone</th>
                    <th>
                        <a href="usuario_insere.php" class="btn btn-success btn-block btn-xs">
                            <span>ADICIONAR<br> </span>
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <!-- abre looping -->
                 <?php do{ ?>
                <tr>
                    <td><?php echo $row['foto_usuario']?></td>
                    <td><?php echo $row['nome_usuario']?></td>
                    <td><?php echo $row['senha_usuario']?></td>
                    <td><?php echo $row['tipo_usuario']?></td>
                    <td><?php echo $row['telefone_usuario']?></td>
                </tr>
                <?php }while($row = $lista->fetch_assoc()); ?>
            </tbody>
        </table>
    </main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
