<?php
// Incluindo o Sistema de autenticação
include("acesso_user.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

// Selecionar os dados
$consulta = "SELECT * FROM tbtipos ORDER BY rotulo_tipo ASC;";

// Fazer uma lista completa dos dados
$lista = $conn_alimentos->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos - Lista</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
    <?php include("menu_adm.php"); ?>
    
    <main class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                
                <h1 class="text-center" style="color: #ffab45; text-shadow: 1px 1px 3px rgba(0,0,0,0.2); margin-bottom: 20px;">
                    <i class="fa-solid fa-layer-group"></i> Lista de Tipos
                </h1>
                
                <div class="lista-wrapper borda-laranja">
                    <table class="table table-hover table-condensed tbopacidade">
                        <thead>
                            <tr>
                                <th class="hidden">ID</th>
                                <th>SIGLA</th>
                                <th>RÓTULO</th>
                                <th class="text-center" style="width: 25%;">AÇÕES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($totalRows > 0) { do { ?>
                                <tr>
                                    <td class="hidden"><?php echo $row['id_tipo']; ?></td>
                                    <td><strong><?php echo $row['sigla_tipo']; ?></strong></td>
                                    <td><?php echo $row['rotulo_tipo']; ?></td>
                                    <td>
                                        <div class="acoes-container">
                                            <a href="tipos_atualiza.php?id_tipo=<?php echo $row['id_tipo']; ?>" class="btn botao-laranja laranja-escuro" style="padding: 5px 10px; font-size: 13px;" title="Editar">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            
                                            <button data-id="<?php echo $row['id_tipo']; ?>" data-nome="<?php echo $row['rotulo_tipo']; ?>" class="btn btn-danger delete" style="border-radius: 5px; transition: transform 0.3s;" title="Excluir">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } while ($row = $lista->fetch_assoc()); } else { ?>
                                <tr>
                                    <td colspan="3" class="text-center">Nenhum tipo cadastrado.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="tipos_insere.php" style="text-decoration: none;">
                                <button class="btn botao-laranja laranja-escuro btn-block" style="padding: 12px; font-size: 16px;">
                                    <i class="fa-solid fa-plus"></i> Inserir Novo Tipo
                                </button>
                            </a>
                        </div>
                    </div>

                </div> </div>
        </div>
    </main>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm"> <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header" style="background-color: #dc3545; color: white; border: none;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                    <h4 class="modal-title"><i class="fa-solid fa-triangle-exclamation"></i> ATENÇÃO!</h4>
                </div>
                <div class="modal-body text-center" style="padding: 30px;">
                    <p style="font-size: 16px;">Deseja mesmo <strong>EXCLUIR</strong> o item?</p>
                    <h3 class="nome text-danger" style="margin-top: 10px; font-weight: bold;"></h3>
                </div>
                <div class="modal-footer" style="border: none; text-align: center; padding-bottom: 20px;">
                    <button class="btn btn-default" data-dismiss="modal" style="border-radius: 5px; margin-right: 10px;">
                        Cancelar
                    </button>
                    <a href="#" class="btn btn-danger delete-yes" style="border-radius: 5px;">
                        <i class="fa-solid fa-trash"></i> Sim, Excluir
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            // Animação leve no botão de excluir ao passar o mouse
            $('.btn-danger.delete').hover(
                function() { $(this).css('transform', 'scale(1.1)'); },
                function() { $(this).css('transform', 'scale(1)'); }
            );

            // Abre o modal de excluir
            $('.delete').on('click', function () {
                var nome = $(this).data('nome');
                var id = $(this).data('id');
                $('h3.nome').text(nome); // Coloca o nome no H3 do modal
                $('a.delete-yes').attr('href', 'tipos_exclui.php?id_tipo=' + id);
                $('#myModal').modal('show');
            });
        });
    </script>

</body>
</html>
<?php mysqli_free_result($lista); ?>