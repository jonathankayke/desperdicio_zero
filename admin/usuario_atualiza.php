<?php
include("../Connections/conn_alimentos.php");

/* ===========================
   UPDATE – BUSCAR USUÁRIO
=========================== */
if(isset($_GET['id'])){
    mysqli_select_db($conn_alimentos, $database_conn);
    $id_usuario = $_GET['id'];

    $sql_busca = "SELECT * FROM tbusuarios WHERE id_usuario = $id_usuario";
    $resultado_busca = $conn_alimentos->query($sql_busca);
    $dados_usuario = $resultado_busca->fetch_assoc();
}

/* ===========================
   CREATE / UPDATE
=========================== */
if(isset($_POST['enviar'])){
    
    mysqli_select_db($conn_alimentos, $database_conn);

    $email_usuario = $_POST['email_usuario'];

    /* ===========================
       VALIDA EMAIL APENAS NO CREATE
    ============================ */
    if(!isset($_POST['id_usuario'])){
        $busca_email = "SELECT id_usuario FROM tbusuarios WHERE email_usuario = '$email_usuario'";
        $resultado_busca = $conn_alimentos->query($busca_email);

        if($resultado_busca->num_rows > 0){
            echo "<script>
                    alert('ATENÇÃO: Este email já está cadastrado! Tente outro.');
                    window.history.back();
                  </script>";
            exit; 
        }
    }

    /* ===========================
       FOTO (MANTÉM A ATUAL)
    ============================ */
    $nome_img = $_POST['foto_atual'] ?? "sem_imagem.jpg"; 
    
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

    /* ===========================
       UPDATE
    ============================ */
    if(isset($_POST['id_usuario'])){

        $id_usuario = $_POST['id_usuario'];

        $sql = "UPDATE tbusuarios SET
                    nome_usuario  = '$nome_usuario',
                    email_usuario = '$email_usuario',
                    login_usuario = '$login_usuario',
                    senha_usuario = '$senha_usuario',
                    tipo_usuario  = '$tipo_usuario',
                    foto_usuario  = '$nome_img'
                WHERE id_usuario = $id_usuario";

    } else {

        /* ===========================
           CREATE (ORIGINAL)
        ============================ */
        $sql = "INSERT INTO tbusuarios 
                (nome_usuario, email_usuario, login_usuario, senha_usuario, tipo_usuario, foto_usuario) 
                VALUES 
                ('$nome_usuario', '$email_usuario', '$login_usuario', '$senha_usuario', '$tipo_usuario', '$nome_img')";
    }

    $resultado = $conn_alimentos->query($sql);

    if($resultado){
        header("Location: usuario_lista.php");
    }else{
        echo "Erro ao salvar: " . $conn_alimentos->error;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include("menu_adm.php"); ?>

<div class="container">
<div class="row">
<div class="col-xs-12 col-md-10 col-md-offset-1">

<h1 class="text-center" style="color: white; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); margin-bottom: 20px;">
Cadastro de Usuários
</h1>

<div class="thumbnail" style="border: none; background: none;">
<div class="alert alert-success" role="alert">

<form action="" method="POST" enctype="multipart/form-data" name="form_usuario" id="form_usuario">

<!-- UPDATE -->
<?php if(isset($dados_usuario)){ ?>
<input type="hidden" name="id_usuario" value="<?= $dados_usuario['id_usuario']; ?>">
<input type="hidden" name="foto_atual" value="<?= $dados_usuario['foto_usuario']; ?>">
<?php } ?>

<div class="row">
<div class="col-md-6">
<h3 class="secao-titulo">Dados Pessoais</h3>

<div class="form-group">
<label>Nome Completo</label>
<input type="text" class="form-control" name="nome_usuario"
value="<?= $dados_usuario['nome_usuario'] ?? ''; ?>" required>
</div>

<div class="form-group">
<label>E-mail</label>
<input type="email" class="form-control" name="email_usuario"
value="<?= $dados_usuario['email_usuario'] ?? ''; ?>" required>
</div>

<div class="form-group">
<label>Foto do usuário</label>
<input type="file" name="foto_usuario" id="foto_usuario" class="form-control" accept="image/*">
</div>

<?php if(isset($dados_usuario)){ ?>
<img src="../imagens/<?= $dados_usuario['foto_usuario']; ?>" class="img-responsive center-block" style="max-height:200px;">
<?php } ?>

</div>

<div class="col-md-6">
<h3 class="secao-titulo">Dados de Acesso</h3>

<div class="form-group">
<label>Login</label>
<input type="text" class="form-control" name="login_usuario"
value="<?= $dados_usuario['login_usuario'] ?? ''; ?>" required>
</div>

<div class="form-group">
<label>Senha</label>
<input type="password" class="form-control" name="senha_usuario"
value="<?= $dados_usuario['senha_usuario'] ?? ''; ?>" required>
</div>

<div class="form-group">
<label>Nível de Acesso</label>
<select class="form-control" name="tipo_usuario" required>
<option value="Admin" <?= (isset($dados_usuario) && $dados_usuario['tipo_usuario']=="Admin")?'selected':''; ?>>Admin</option>
<option value="User" <?= (isset($dados_usuario) && $dados_usuario['tipo_usuario']=="User")?'selected':''; ?>>User</option>
</select>
</div>

</div>
</div>

<input type="submit" name="enviar"
value="<?= isset($dados_usuario) ? 'Atualizar Usuário' : 'Cadastrar Usuário'; ?>"
class="btn btn-success btn-block">

</form>

</div>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>
