<?php
// Incluindo o Sistema de autenticação
include("acesso_admin.php");

include("../Connections/conn_alimentos.php");

/* ==========================
   1. RECEBE O ID (GET)
========================== */
if (!isset($_GET['id_usuario'])) {
    die("Usuário não informado.");
}

$id_usuario = (int) $_GET['id_usuario'];

/* ==========================
   2. BUSCA DADOS DO USUÁRIO
========================== */
$sql_usuario = "SELECT * FROM tbusuarios WHERE id_usuario = $id_usuario";
$resultado_usuario = $conn_alimentos->query($sql_usuario);

if ($resultado_usuario->num_rows == 0) {
    die("Usuário não encontrado.");
}

$row = $resultado_usuario->fetch_assoc();

/* ==========================
   3. ATUALIZA USUÁRIO
========================== */
if (isset($_POST['enviar'])) {

    mysqli_select_db($conn_alimentos, $database_conn);

    $email_usuario = $_POST['email_usuario'];

    // Verifica email duplicado (exceto o próprio usuário)
    $busca_email = "
        SELECT id_usuario FROM tbusuarios 
        WHERE email_usuario = '$email_usuario'
        AND id_usuario <> $id_usuario
    ";
    $resultado_busca = $conn_alimentos->query($busca_email);

    if ($resultado_busca->num_rows > 0) {
        echo "<script>
                alert('ATENÇÃO: Este email já está cadastrado! Tente outro.');
                window.history.back();
              </script>";
        exit;
    }

    // Mantém foto atual
    $nome_img = $row['foto_usuario'];

    // Nova foto (opcional)
    if (isset($_FILES['foto_usuario']) && $_FILES['foto_usuario']['error'] === 0) {
        $nome_img   = $_FILES['foto_usuario']['name'];
        $tmp_img    = $_FILES['foto_usuario']['tmp_name'];
        $dir_img    = "../imagens/" . $nome_img;
        move_uploaded_file($tmp_img, $dir_img);
    }

    $nome_usuario   = $_POST['nome_usuario'];
    $login_usuario  = $_POST['login_usuario'];
    $senha_usuario  = $_POST['senha_usuario'];
    $tipo_usuario   = $_POST['tipo_usuario'];

    $updateSQL = "
        UPDATE tbusuarios SET
            nome_usuario  = '$nome_usuario',
            email_usuario = '$email_usuario',
            login_usuario = '$login_usuario',
            senha_usuario = '$senha_usuario',
            tipo_usuario  = '$tipo_usuario',
            foto_usuario  = '$nome_img'
        WHERE id_usuario = $id_usuario
    ";

    if ($conn_alimentos->query($updateSQL)) {
        header("Location: usuario_lista.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn_alimentos->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário - Área Admin</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
    
    <?php include("menu_adm.php"); ?>
    
    <div class="container" style="margin-top: 30px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <div class="panel panel-default panel-custom">
                    
                    <div class="panel-heading panel-heading-custom text-center">
                        <h3 style="margin: 0; font-weight: bold;">
                            <i class="fa-solid fa-user-pen"></i> Atualizar Usuário
                        </h3>
                    </div>

                    <div class="panel-body" style="padding: 30px;">
                        
                        <form action="" method="POST" enctype="multipart/form-data" name="form_usuario" id="form_usuario">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="secao-form">Dados Pessoais</h4>
                                    
                                    <div class="form-group">
                                        <label>Nome Completo</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-user text-info"></i></span>
                                            <input type="text" class="form-control" name="nome_usuario" value="<?php echo htmlspecialchars($row['nome_usuario']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-envelope text-info"></i></span>
                                            <input type="email" class="form-control" name="email_usuario" value="<?php echo htmlspecialchars($row['email_usuario']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Foto do Perfil</label>
                                        <div class="well text-center" style="margin-bottom: 0;">
                                            <?php 
                                                $foto_atual = ($row['foto_usuario'] != '') ? $row['foto_usuario'] : 'sem_imagem.jpg';
                                            ?>
                                            <img src="../imagens/<?php echo $foto_atual; ?>" id="imagem" class="img-circle" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #ddd; margin-bottom: 10px;">
                                            
                                            <input type="file" name="foto_usuario" id="foto_usuario" class="form-control" accept="image/*" style="padding-top: 10px;">
                                            <small class="text-muted">Apenas envie uma nova foto se quiser alterar a atual.</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h4 class="secao-form">Dados de Acesso</h4>

                                    <div class="form-group">
                                        <label>Login (Usuário)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-arrow-right-to-bracket text-info"></i></span>
                                            <input type="text" class="form-control" name="login_usuario" value="<?php echo htmlspecialchars($row['login_usuario']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Senha</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-lock text-info"></i></span>
                                            <input type="text" class="form-control" name="senha_usuario" value="<?php echo htmlspecialchars($row['senha_usuario']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Nível de Acesso</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-shield-halved text-info"></i></span>
                                            <select class="form-control" name="tipo_usuario" required>
                                                <option value="Admin" <?php if($row['tipo_usuario'] == 'Admin'){ echo 'selected'; } ?>>Administrador (Total)</option>
                                                <option value="User" <?php if($row['tipo_usuario'] == 'User'){ echo 'selected'; } ?>>Usuário Padrão</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="usuario_lista.php" class="btn btn-default btn-block btn-lg" style="margin-bottom: 10px;">
                                        <i class="fa-solid fa-arrow-left"></i> Cancelar
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <button type="submit" name="enviar" class="btn btn-cadastrar btn-block btn-lg" style="background-color: #007BFF; border-color: #007BFF;">
                                        <i class="fa-solid fa-floppy-disk"></i> Atualizar
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
            
            if(this.files[0].size > 5242880){
                alert("A imagem é muito grande! Máximo de 5MB.");
                $(this).val(''); 
                return false;
            }
            
            if(this.files[0].type.indexOf("image") == -1){
                alert("Arquivo inválido. Por favor envie uma imagem.");
                $(this).val('');
                return false;
            }

            reader.onload = function(e){
                document.getElementById("imagem").src = e.target.result;
            };
            
            reader.readAsDataURL(this.files[0]);
        };
    </script>

</body>
</html>