<?php
// Incluindo o Sistema de autenticação
include("acesso_user.php");

include("../Connections/conn_alimentos.php");

$consulta = "SELECT * FROM vw_doacoes ORDER BY nome_alimento ASC;";
$lista = $conn_alimentos->query($consulta);
$totalRows = $lista->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Doações - Área Admin</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
    <?php include('menu_adm.php'); ?>
    
    <main class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-xs-12">
                
                <h1 class="text-center" style="color: #28A745; text-shadow: 1px 1px 3px rgba(0,0,0,0.2); margin-bottom: 20px;">
                    <i class="fa-solid fa-basket-shopping"></i> Lista de Doações
                </h1>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <a href="Doacao_insere.php" style="text-decoration: none;">
                                <button class="btn botao-verde verde-escuro btn-block" style="padding: 12px; font-size: 16px;">
                                    <i class="fa-solid fa-plus"></i> Inserir Nova Doação
                                </button>
                            </a>
                        </div> 
                    </div>
                <div class="lista-wrapper borda-verde">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed tbopacidade fontelista">
                            <thead>
                                <tr>
                                    <th class="hidden">ID</th>
                                    <th>Imagem</th>
                                    <th class="hidden-xs">Empresa</th>
                                    <th class="hidden-xs">Contato</th>
                                    <th class="hidden-xs">Categoria</th>
                                    <th>Nome Alimento</th>
                                    <th class="hidden-xs">Quantidade</th>
                                    <th class="hidden-xs">Validade</th>
                                    <th class="hidden-xs">Endereço</th>
                                    <th class="visible-xs"></th>
                                    <th class="text-center" style="width: 15%;">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($totalRows > 0) { while ($row = $lista->fetch_assoc()) { ?>
                                    <tr>
                                        <td>
                                            <img src="../imagens/<?php echo $row['imagem_doacao']; ?>" alt="Imagem" width="80px" style="height: 60px; object-fit: cover; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                        </td>
                                        
                                        <td class="hidden"><?php echo $row['id_doacao']; ?></td>
                                        <td class="hidden-xs"><?php echo $row['nome_empresa'] ?></td>
                                        <td class="hidden-xs"><?php echo $row['contato_doacao'] ?></td>
                                        <td class="hidden-xs"><span class="label label-success"><?php echo $row['rotulo_tipo'] ?></span></td>
                                        <td><strong><?php echo $row['nome_alimento'] ?></strong></td>
                                        <td class="hidden-xs"><?php echo $row['quantidade_doacao'] ?></td>
                                        <td class="hidden-xs"><?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?></td>
                                        <td class="hidden-xs"><?php echo $row['endereco_retirada'] ?></td>
                                        
                                        <td class="visible-xs">
                                            <button class="btn btn-info btn-xs btn-block" data-toggle="collapse" data-target="#detalhe<?php echo $row['id_doacao']; ?>" style="border-radius: 5px;">
                                                <i class="fa-solid fa-eye"></i> Detalhes
                                            </button>
                                        </td>
                                        
                                        <td>
                                            <div class="acoes-container">
                                                <a href="Doacao_atualiza.php?id_doacao=<?php echo $row['id_doacao'] ?>" class="btn botao-verde verde-escuro" style="padding: 5px 10px; font-size: 13px;" title="Editar">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <button class="btn btn-danger delete" data-nome="<?php echo $row['nome_alimento'] ?>" data-id="<?php echo $row['id_doacao'] ?>" style="border-radius: 5px; transition: transform 0.3s;" title="Excluir">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr class="visible-xs">
                                        <td colspan="10" style="padding:0; border:none;">
                                            <div id="detalhe<?php echo $row['id_doacao']; ?>" class="collapse detalhes-container" style="margin: 10px 0; border-top: 2px solid #28A745;">
                                                <strong><i class="fa-solid fa-building text-success"></i> Empresa:</strong> <?php echo $row['nome_empresa']; ?><br>
                                                <strong><i class="fa-brands fa-whatsapp text-success"></i> Contato:</strong> <?php echo $row['contato_doacao']; ?><br>
                                                <strong><i class="fa-solid fa-list text-success"></i> Categoria:</strong> <?php echo $row['rotulo_tipo']; ?><br>
                                                <strong><i class="fa-solid fa-weight-hanging text-success"></i> Quantidade:</strong> <?php echo $row['quantidade_doacao']; ?><br>
                                                <strong><i class="fa-solid fa-calendar-days text-success"></i> Validade:</strong> <?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?><br>
                                                <strong><i class="fa-solid fa-map-location-dot text-success"></i> Endereço:</strong> <?php echo $row['endereco_retirada']; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="10" class="text-center text-muted">Nenhuma doação cadastrada no momento.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </main>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                <div class="modal-header" style="background-color: #dc3545; color: white; border: none;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                    <h4 class="modal-title"><i class="fa-solid fa-triangle-exclamation"></i> ATENÇÃO!</h4>
                </div>
                <div class="modal-body text-center" style="padding: 30px;">
                    <p style="font-size: 16px;">Deseja mesmo <strong>EXCLUIR</strong> a doação?</p>
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
            $('.delete').on('click', function () {
                var nome = $(this).data('nome');
                var id = $(this).data('id');
                $('h3.nome').text(nome);
                $('a.delete-yes').attr('href', 'doacao_exclui.php?id_doacao=' + id);
                $('#myModal').modal('show');
            });
        });
    </script>
</body>

</html>