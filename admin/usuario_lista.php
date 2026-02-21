<?php
// Incluindo o Sistema de autenticação
include("acesso_admin.php");

include('../Connections/conn_alimentos.php');

$consulta   =   "SELECT * FROM tbusuarios ORDER BY nome_usuario ASC;";

$lista      =   $conn_alimentos->query($consulta);
$totalRows  =   $lista->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - Área Admin</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
    <?php include("menu_adm.php"); ?>
    
    <main class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-xs-12">
                
                <h1 class="text-center" style="color: #007BFF; text-shadow: 1px 1px 3px rgba(0,0,0,0.2); margin-bottom: 20px;">
                    <i class="fa-solid fa-users-gear"></i> Lista de Usuários
                </h1>
                    <div class="row">
                        <div class="col-xs-12 col-md-6 col-md-offset-3">
                            <a href="usuario_insere.php" style="text-decoration: none;">
                                <button class="btn botao-azul azul-escuro btn-block" style="padding: 12px; font-size: 16px;">
                                    <i class="fa-solid fa-user-plus"></i> Inserir Novo Usuário
                                </button>
                            </a>
                        </div>
                    </div>
                <div class="lista-wrapper borda-azul">
                    <div class="table-responsive">
                        <table class="table table-hover table-condensed tbopacidade fontelista">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nome</th>
                                    <th class="hidden-xs">Senha</th>
                                    <th class="hidden-xs">Tipo</th>
                                    <th class="hidden-xs">Email</th>
                                    <th class="hidden-xs">Login</th>
                                    <th class="visible-xs"></th>
                                    <th class="text-center" style="width: 15%;">AÇÕES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($totalRows > 0) { while ($row = $lista->fetch_assoc()) { 
                                    // Verifica se o usuário tem foto, senão usa a padrão
                                    $foto_exibicao = ($row['foto_usuario'] != '') ? $row['foto_usuario'] : 'sem_imagem.jpg';
                                ?>
                                    <tr>
                                        <td>
                                            <img src="../imagens/<?php echo $foto_exibicao; ?>" alt="<?php echo $row['nome_usuario']; ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border: 2px solid #007BFF;">
                                        </td>
                                        
                                        <td><strong><?php echo $row['nome_usuario']; ?></strong></td>
                                        <td class="hidden-xs"><?php echo str_repeat('*', strlen($row['senha_usuario'])); ?> </td>
                                        
                                        <td class="hidden-xs">
                                            <?php if($row['tipo_usuario'] == 'Admin'){ ?>
                                                <span class="label label-primary"><i class="fa-solid fa-shield-halved"></i> Admin</span>
                                            <?php } else { ?>
                                                <span class="label label-default"><i class="fa-solid fa-user"></i> User</span>
                                            <?php } ?>
                                        </td>
                                        
                                        <td class="hidden-xs"><?php echo $row['email_usuario']; ?></td>
                                        <td class="hidden-xs"><?php echo $row['login_usuario']; ?></td>
                                        
                                        <td class="visible-xs">
                                            <button class="btn btn-info btn-xs btn-block" data-toggle="collapse" data-target="#detalhe<?php echo $row['id_usuario']; ?>" style="border-radius: 5px;">
                                                <i class="fa-solid fa-eye"></i> Info
                                            </button>
                                        </td>
                                        
                                        <td>
                                            <div class="acoes-container">
                                                <a href="usuario_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>" class="btn botao-azul azul-escuro" style="padding: 5px 10px; font-size: 13px;" title="Editar">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <button data-id="<?php echo $row['id_usuario']; ?>" data-nome="<?php echo $row['nome_usuario']; ?>" class="btn btn-danger delete" style="border-radius: 5px; transition: transform 0.3s;" title="Excluir">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr class="visible-xs">
                                        <td colspan="10" style="padding:0; border:none;">
                                            <div id="detalhe<?php echo $row['id_usuario']; ?>" class="collapse detalhes-container" style="margin: 10px 0; border-top: 2px solid #007BFF;">
                                                <strong><i class="fa-solid fa-shield-halved text-primary"></i> Tipo:</strong> <?php echo $row['tipo_usuario']; ?><br>
                                                <strong><i class="fa-solid fa-envelope text-primary"></i> Email:</strong> <?php echo $row['email_usuario']; ?><br>
                                                <strong><i class="fa-solid fa-arrow-right-to-bracket text-primary"></i> Login:</strong> <?php echo $row['login_usuario']; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Nenhum usuário cadastrado.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div> </div>
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
                    <p style="font-size: 16px;">Deseja mesmo <strong>EXCLUIR</strong> o Usuário?</p>
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
            $('.delete').on('click', function() {
                var nome = $(this).data('nome');
                var id = $(this).data('id');
                $('h3.nome').text(nome); // Injeta o nome do Usuário
                $('a.delete-yes').attr('href', 'usuario_exclui.php?id_usuario=' + id);
                $('#myModal').modal('show');
            });
        });
    </script>

</body>
</html>