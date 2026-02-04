<?php
include("../Connections/conn_alimentos.php");

$consulta   =   "
                SELECT      *
                FROM        vw_doacoes
                ORDER BY    nome_alimento ASC;
                ";

$lista      =   $conn_alimentos->query($consulta);
$totalRows  =   $lista->num_rows;
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
            <small class="badge"><?php echo $totalRows; ?></small>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-condensed tbopacidade fontelista">
                <thead>
                    <tr>
                        <th class="hidden">ID</th>
                        <th>IMAGEM</th>
                        <th class="hidden-xs">Empresa</th>
                        <th class="hidden-xs">Contato</th>
                        <th class="hidden-xs">Categoria</th>
                        <th>Nome Alimento</th>
                        <th class="hidden-xs">Quantidade</th>
                        <th class="hidden-xs">Validade</th>
                        <th class="hidden-xs">Endereço</th>
                        <th class="visible-xs"></th>
                        <th>
                        <a href="Doacao_insere.php" class="btn btn-block btn-success btn-xs">
                            <span></span>
                            <span class="glyphicon glyphicon-plus"></span>
                        </a> 
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- abre looping -->
                    <?php while($row = $lista->fetch_assoc()) { ?>
                    <tr>
                        <td class="">
                            <img src="../imagens/<?php echo $row['imagem_doacao']; ?>" alt="" width="100px" style="max-height :70px;" class="bordaimagem">
                        </td>
                        <td class="hidden"><?php echo $row['id_doacao']; ?></td>
                        <td class="hidden-xs"><?php echo $row['nome_empresa']?></td>
                        <td class="hidden-xs"><?php echo $row['contato_doacao']?></td>
                        <td class="hidden-xs"><?php echo $row['rotulo_tipo']?></td>
                        <td><?php echo $row['nome_alimento']?></td>
                        <td class="hidden-xs"><?php echo $row['quantidade_doacao']?></td>
                        <td class="hidden-xs"><?php echo $row['validade_doacao']?></td>
                        <td class="hidden-xs"><?php echo $row['endereco_retirada']?></td>
                        <td class="visible-xs">
                            <button 
                                class="btn btn-info btn-xs btn-block btn-detalhe"
                                data-toggle="collapse"
                                data-target="#detalhe<?php echo $row['id_doacao']; ?>"
                            >
                                Ver detalhes
                            </button>
                        </td>
                        <td>
                            <a href="Doacao_atualiza.php?id_doacao=<?php echo $row['id_doacao']?>" class="btn btn-block btn-warning" target="_self" role="button">
                                <span></span>
                                <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                            <button class="btn btn-danger btn-block delete" data-nome="<?php echo $row['nome_alimento']?>" data-id="<?php echo $row['id_doacao']?>">
                                <span class=""></span>
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="visible-xs">
                        <td colspan="10" style="padding:0">
                            <div id="detalhe<?php echo $row['id_doacao']; ?>" class="collapse detalhes-container">
                                <strong>Empresa:</strong> <?php echo $row['nome_empresa']; ?><br>
                                <strong>Contato:</strong> <?php echo $row['contato_doacao']; ?><br>
                                <strong>Categoria:</strong> <?php echo $row['rotulo_tipo']; ?><br>
                                <strong>Quantidade:</strong> <?php echo $row['quantidade_doacao']; ?><br>
                                <strong>Validade:</strong> <?php echo $row['validade_doacao']; ?><br>
                                <strong>Endereço:</strong> <?php echo $row['endereco_retirada']; ?>
                            </div>
                        </td>
                    </tr>              
                    <?php } ?>
                    <!-- fecha looping -->
                </tbody>
            </table>
        </div>
    </main>

    <!-- Modal -->
     <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-danger">ATENÇÃO</h4>
                </div> <!-- fecha modal-header -->
                <div class="modal-body">
                    Deseja mesmo excluir a doação?
                    <h4><span class="nome text-danger"></span></h4>
                </div> <!-- fecha modal-body -->
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">Confirmar</a>
                    <button class="btn btn-success" data-dismiss="modal">
                        Cancelar
                    </button>
                </div> <!-- fecha modal-footer -->
            </div>
        </div>
     </div>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<!-- script para modal -->
 <script type="text/javascript">
    $('.delete').on('click',function(){
        var nome    =   $(this).data('nome');
        var id      =   $(this).data('id');
        $('span.nome').text(nome);
        $('a.delete-yes').attr('href','doacao_exclui.php?id_doacao='+id);
        $('#myModal').modal('show');
    });
 </script>
</body>
</html>
