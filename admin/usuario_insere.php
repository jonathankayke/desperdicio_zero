<?php
// Incluindo o Sistema de autenticação
include("acesso_admin.php");

include("../Connections/conn_alimentos.php");

if(isset($_POST['enviar'])){
    
    mysqli_select_db($conn_alimentos, $database_conn);

    $email_usuario = $_POST['email_usuario'];

    $busca_email = "SELECT id_usuario FROM tbusuarios WHERE email_usuario = '$email_usuario'";
    $resultado_busca = $conn_alimentos->query($busca_email);

    if($resultado_busca->num_rows > 0){
        echo "<script>
                alert('ATENÇÃO: Este email já está cadastrado! Tente outro.');
                window.history.back();
              </script>";
        exit; 
    }

    $nome_img = "sem_imagem.jpg"; 
    
    if(isset($_FILES['foto_usuario']) && $_FILES['foto_usuario']['error'] === 0){
        $nome_img   = $_FILES['foto_usuario']['name'];
        $tmp_img    = $_FILES['foto_usuario']['tmp_name'];
        $dir_img    = "../imagens/" . $nome_img; 
        move_uploaded_file($tmp_img, $dir_img);
    }

    $nome_usuario   = $_POST['nome_usuario'];
    $login_usuario  = $_POST['login_usuario'];
    $senha_usuario  = $_POST['senha_usuario']; 
    $tipo_usuario   = $_POST['tipo_usuario'];
    
    $insertSQL  = "INSERT INTO tbusuarios 
                    (nome_usuario, email_usuario, login_usuario, senha_usuario, tipo_usuario, foto_usuario) 
                   VALUES 
                    ('$nome_usuario', '$email_usuario', '$login_usuario', '$senha_usuario', '$tipo_usuario', '$nome_img')";
    
    $resultado  = $conn_alimentos->query($insertSQL);

    if($resultado){
        header("Location: usuario_lista.php");
    }else{
        echo "Erro ao inserir: " . $conn_alimentos->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários - Área Admin</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
    
    <style>
        /* Estilos Específicos para este Formulário */
        
    </style>
</head>

<body class="fundofixo">
    
    <?php include("menu_adm.php"); ?>
    
    <div class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <div class="panel panel-default panel-custom">
                    
                    <div class="panel-heading panel-heading-custom text-center">
                        <h3 style="margin: 0; font-weight: bold;">
                            <i class="fa-solid fa-user-plus"></i> Novo Usuário
                        </h3>
                    </div>

                    <div class="panel-body" style="padding: 30px;">
                        
                        <form action="" method="POST" enctype="multipart/form-data" name="form_usuario" id="form_usuario">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="secao-form-user">Dados Pessoais</h4>
                                    
                                    <div class="form-group">
                                        <label>Nome Completo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-user text-info"></i></span>
                                            <input type="text" class="form-control" name="nome_usuario" placeholder="Digite o nome completo" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-envelope text-info"></i></span>
                                            <input type="email" class="form-control" name="email_usuario" placeholder="email@exemplo.com" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Foto do Perfil</label>
                                        <div class="well text-center" style="margin-bottom: 0;">
                                            <img src="../imagens/sem_imagem.jpg" id="imagem" class="img-circle" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #ddd; margin-bottom: 10px;">
                                            
                                            <input type="file" name="foto_usuario" id="foto_usuario" class="form-control" accept="image/*" style="padding-top: 10px;">
                                            <small class="text-muted">Formatos: JPG, PNG (Max: 5MB)</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h4 class="secao-form-user">Dados de Acesso</h4>

                                    <div class="form-group">
                                        <label>Login (Usuário)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-arrow-right-to-bracket text-info"></i></span>
                                            <input type="text" class="form-control" name="login_usuario" placeholder="Ex: admin.sistema" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Senha</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-lock text-info"></i></span>
                                            <input type="password" class="form-control" name="senha_usuario" placeholder="Crie uma senha segura" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nível de Acesso</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-shield-halved text-info"></i></span>
                                            <select class="form-control" name="tipo_usuario" required>
                                                <option value="" disabled selected>Selecione o nível...</option>
                                                <option value="Admin">Administrador (Total)</option>
                                                <option value="User">Usuário Padrão</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="alert alert-info" style="margin-top: 30px;">
                                        <i class="fa-solid fa-circle-info"></i> 
                                        <strong>Dica:</strong> Usuários "Admin" podem excluir registros. Cuidado ao atribuir essa permissão.
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <a href="usuario_lista.php" class="btn btn-default btn-block btn-lg" style="margin-bottom: 10px;">
                                        <i class="fa-solid fa-arrow-left"></i> Voltar
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" name="enviar" class="btn btn-cadastrar-user btn-block btn-lg">
                                        <i class="fa-solid fa-check"></i> Salvar Cadastro
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div> </div> </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script>
        document.getElementById("foto_usuario").onchange = function(){
            var reader = new FileReader();
            
            // Valida Tamanho (5MB)
            if(this.files[0].size > 5242880){
                alert("A imagem é muito grande! Máximo de 5MB.");
                $(this).val(''); // Limpa o input
                return false;
            }
            
            // Valida Tipo
            if(this.files[0].type.indexOf("image") == -1){
                alert("Arquivo inválido. Por favor envie uma imagem.");
                $(this).val('');
                return false;
            }

            reader.onload = function(e){
                // Atualiza o SRC da imagem redonda
                document.getElementById("imagem").src = e.target.result;
            };
            
            reader.readAsDataURL(this.files[0]);
        };
    </script>

</body>
</html> 