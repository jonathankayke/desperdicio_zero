<?php
include("../Connections/conn_alimentos.php");

$consulta   =   "
                SELECT      *
                FROM        vw_doacoes
                ORDER BY    nome_alimento ASC;
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
    <title>Lista de Doações</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="fundofixo">
<?php include('menu_adm.php'); ?>
    <main class="container">
        <h1 class="breadcrumb alert-success text-center">Lista de Doações</h1>
        <div class="btn btn-success disabled">
            Total de Produtos:
        </div>
        <table class="table table-hover table-condensed tbopacidade fontelista">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th>Instituição</th>
                    <th>Alimento</th>
                    <th>Quantidade</th>
                    <th>Validade</th>
                    <th>Endereço</th>
                    <th>IMAGEM</th>
                    <th>
                    <a href="Doacao_insere.php" class="btn btn-block btn-success btn-xs">
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
                    <td class="hidden"><?php echo $row['id_doacao']; ?></td>
                    <td><?php echo $row['nome_doacao']?></td>
                    <td><?php echo $row['nome_alimento']?></td>
                    <td><?php echo $row['quantidade_doacao']?></td>
                    <td><?php echo $row['validade_doacao']?></td>
                    <td><?php echo $row['endereco_retirada']?></td>
                    <td>
                        <img src="../imagens/<?php echo $row['imagem_doacao']; ?>" alt="" width="100px">
                    </td>
                    <td>
                        <a href="Doacao_atualiza.php?id_doacao=<?php echo $row['id_doacao']?>" class="btn btn-block btn-warning" target="_self" role="button">
                            <span>ALTERAR<br> </span>
                            <span class="glyphicon glyphicon-refresh"></span>
                        </a>
                        <button class="btn btn-danger btn-block delete" data-nome="<?php echo $row['nome_alimento']?>" data-id="<?php echo $row['id_doacao']?>">
                            <span class="">EXCLUIR <br></span>
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </td>
                </tr>
                <?php }while($row = $lista->fetch_assoc()); ?>
                <!-- fecha looping -->
            </tbody>
        </table>
    </main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
