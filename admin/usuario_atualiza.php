<?php


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
    <title>Atualizar Usuário</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">
<?php include("menu_adm.php"); ?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
            <h1 class="text-center" style="color:white;">Atualizar Usuário</h1>

            <div class="thumbnail" style="border:none; background:none;">
                <div class="alert alert-success">

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="secao-titulo">Dados Pessoais</h3>

                                <div class="form-group">
                                    <label>Nome Completo</label>
                                    <input type="text" name="nome_usuario"
                                           class="form-control"
                                           value="<?php echo $row['nome_usuario']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email_usuario"
                                           class="form-control"
                                           value="<?php echo $row['email_usuario']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Foto do usuário</label>
                                    <input type="file" name="foto_usuario" class="form-control">
                                    <br>
                                    <img src="../imagens/<?php echo $row['foto_usuario']; ?>"
                                         class="img-responsive img-thumbnail"
                                         style="max-height:200px;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h3 class="secao-titulo">Dados de Acesso</h3>

                                <div class="form-group">
                                    <label>Login</label>
                                    <input type="text" name="login_usuario"
                                           class="form-control"
                                           value="<?php echo $row['login_usuario']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="text" name="senha_usuario"
                                           class="form-control"
                                           value="<?php echo $row['senha_usuario']; ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Nível de Acesso</label>
                                    <select name="tipo_usuario" class="form-control" required>
                                        <option value="Admin" <?php if($row['tipo_usuario']=="Admin") echo "selected"; ?>>Admin</option>
                                        <option value="User"  <?php if($row['tipo_usuario']=="User")  echo "selected"; ?>>User</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <br>

                        <input type="submit" name="enviar"
                               value="Atualizar Usuário"
                               class="btn btn-success btn-block">

                        <a href="usuario_lista.php" class="btn btn-default btn-block">
                            Cancelar
                        </a>

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
