<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");
// Selecionar os dados
$consulta = "
                SELECT  *
                FROM    tbtipos
                ORDER BY rotulo_tipo ASC;
                ";
// Fazer uma lista completa dos dados
$lista = $conn_alimentos->query($consulta);
// Separar os dados em linhas (row)
$row = $lista->fetch_assoc();
// Contar o total de linhas
$totalRows = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos - Lista</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
    <?php include("menu_adm.php"); ?>
    <!-- main>h1 -->
    <main class="container">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <!-- dimensionamento -->
            <h1 class="breadcrumb text-success text-center">Lista dos Tipos</h1>
            <!-- table>thead>tr>th*8 -->
        <div class="lista-wrapper">
            <table class="table table-hover table-condensed tbopacidade">
                <thead>
                    <tr>
                        <th class="hidden">ID</th>
                        <th>SIGLA</th>
                        <th>RÓTULO</th>
                        <th>
                            <a href="tipos_insere.php" class="btn btn-block btn-success btn-xs borda-btn">
                                <span class="hidden-xs"></span>
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </th>
                    </tr>
                </thead>
                <!-- tbody>tr>td*4 -->
                <tbody>
                    <?php do { ?><!-- Abre a estrutura de repetição -->
                        <tr>
                            <td class="hidden"><?php echo $row['id_tipo']; ?></td>
                            <td><?php echo $row['sigla_tipo']; ?></td>
                            <td><?php echo $row['rotulo_tipo']; ?></td>
                            <td>
                                <a href="tipos_atualiza.php?id_tipo=<?php echo $row['id_tipo']; ?>"
                                    class="btn btn-block btn-warning borda-btn" target="_self" role="button">
                                    <span class="hidden-xs"></span>
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </a>
                                <button data-id="<?php echo $row['id_tipo']; ?>"
                                    data-nome="<?php echo $row['rotulo_tipo']; ?>" class="btn btn-danger borda-btn btn-block delete">
                                    <span class="hidden-xs"></span>
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </td>
                        </tr>
                    <?php } while ($row = $lista->fetch_assoc()); ?>
                    <!-- Fechar a estrutura de repetição -->
                </tbody>
            </table>
       </div> </main>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 class="modal-title text-danger">ATENÇÃO!</h4>
                </div> <!-- fecha modal-header -->
                <div class="modal-body">
                    Deseja mesmo EXCLUIR o item?
                    <h4><span class="nome text-danger"></span></h4>
                </div> <!-- fecha modal-body -->
                <div class="modal-footer">
                    <a href="#" type="button" class="btn btn-danger delete-yes">
                        Confirmar
                    </a>
                    <button class="btn btn-success" data-dismiss="modal">
                        Cancelar
                    </button>
                </div> <!-- fecha modal-footer -->
            </div> <!-- fecha modal-content -->
        </div> <!-- fecha modal-dialog -->
    </div> <!-- fecha modal -->

    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <!-- Script para o Modal -->
    <script type="text/javascript">
        $('.delete').on('click', function () {
            var nome = $(this).data('nome');
            // buscar o valor do atributo data-nome
            var id = $(this).data('id');
            // buscar o valor do atributo data-id
            $('span.nome').text(nome);
            // Inserir o nome do item na pergunta de confirmação
            $('a.delete-yes').attr('href', 'tipos_exclui.php?id_tipo=' + id);
            // mudar dinamicamente o id do link no botão confirmar
            $('#myModal').modal('show'); // abre modal
        });
    </script>


</body>

</html>
<?php mysqli_free_result($lista); ?>