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
<?php include("menu_adm.php") ?>
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
                    <th>Email</th>
                    <th>Login</th>
                    <th>
                        <a href="usuario_insere.php" class="btn btn-success btn-block btn-xs">
                            <span>ADICIONAR<br> </span>
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                // O while verifica se existe uma linha antes de tentar imprimir
                while($row = $lista->fetch_assoc()) { 
                ?>
                    <tr>
                        <td>
                            <img src="../imagens/<?php echo $row['foto_usuario']; ?>" alt="<?php echo $row['nome_usuario']; ?>" class="img-responsive img-thumbnail" style="max-width: 80px;">
                        <td><?php echo $row['nome_usuario']; ?></td>
                        <td><?php echo $row['senha_usuario']; ?></td>
                        <td><?php echo $row['tipo_usuario']; ?></td>
                        <td><?php echo $row['email_usuario']; ?></td>
                        <td><?php echo $row['login_usuario']; ?></td>

                        <td>
                            <a href="usuario_atualiza.php" target="_self" class="btn btn-warning btn-xs btn-block">
                                <span class="hidden-xs">ALTERAR <br></span>
                                <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                            <button class="btn btn-danger btn-xs btn-block delete">
                                <span class="hidden-xs">EXCLUIR<br></span>
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                <?php 
                } // Fim do loop while
                ?>
            </tbody>
        </table>
    </main>

<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
