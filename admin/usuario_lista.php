<?php
include ('../Connections/conn_alimentos.php');

$consulta   =   "
                SELECT      *
                FROM        tbusuarios
                ORDER BY    nome_usuario ASC;
                ";

$lista      =   $conn_alimentos->query($consulta);
$totalRows  =   $lista->num_rows;
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
        <table class="table table-hover table-condensed tbopacidade fontelista">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Senha</th> <!-- ocultar -->
                    <th class="hidden-xs">Tipo</th>
                    <th class="hidden-xs">Email</th>
                    <th class="hidden-xs">Login</th>
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
                        <td class="hidden-xs"><?php echo $row['tipo_usuario']; ?></td>
                        <td class="hidden-xs"><?php echo $row['email_usuario']; ?></td>
                        <td class="hidden-xs"><?php echo $row['login_usuario']; ?></td>
                        <td class="visible-xs">
                            <button 
                                class="btn btn-info btn-xs btn-block btn-detalhe"
                                data-toggle="collapse"
                                data-target="#detalhe<?php echo $row['id_usuario']; ?>"
                            >
                                Ver detalhes
                            </button>
                        </td>
                        <td>
                            <a href="usuario_atualiza.php?id_usuario=<?php echo $row['id_usuario']; ?>"
                                class="btn btn-warning btn-xs btn-block">
                                <span class="hidden-xs">ALTERAR <br></span>
                                <span class="glyphicon glyphicon-refresh"></span>
                            </a>
                            <button
                                data-id="<?php echo $row['id_usuario']; ?>"
                                data-nome="<?php echo $row['login_usuario']; ?>"                        
                                class="btn btn-danger btn-xs btn-block delete"
                                >
                                <span class="hidden-xs">EXCLUIR<br></span>
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </td>
                    </tr>
                    <tr class="visible-xs">
                        <td colspan="10" style="padding:0">
                            <div id="detalhe<?php echo $row['id_usuario']; ?>" class="collapse detalhes-container">
                                <strong>Tipo:</strong> <?php echo $row['tipo_usuario']; ?><br>
                                <strong>Email:</strong> <?php echo $row['email_usuario']; ?><br>
                                <strong>Login:</strong> <?php echo $row['login_usuario']; ?><br>                               
                            </div>
                        </td>
                    </tr> 
                <?php 
                } // Fim do loop while
                ?>
            </tbody>
        </table>
    </main>
    <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                >
                    &times;
                </button>
                <h4 class="modal-title text-danger">ATENÇÃO!</h4>
            </div> <!-- fecha modal-header -->
            <div class="modal-body">
                Deseja mesmo EXCLUIR o Usuário?
                <h4><span class="nome text-danger"></span></h4>
            </div> <!-- fecha modal-body -->
            <div class="modal-footer">
                <a 
                    href="#" 
                    type="button" 
                    class="btn btn-danger delete-yes"
                >
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
    $('.delete').on('click',function(){
        var nome    =   $(this).data('nome');
        // buscar o valor do atributo data-nome
        var id      =   $(this).data('id');
        // buscar o valor do atributo data-id
        $('span.nome').text(nome);
        // Inserir o nome do item na pergunta de confirmação
        $('a.delete-yes').attr('href','usuario_exclui.php?id_usuario='+id);
        // mudar dinamicamente o id do link no botão confirmar
        $('#myModal').modal('show'); // abre modal
    });
</script>

</body>
</html>
