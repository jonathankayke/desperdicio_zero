<?php
include("../Connections/conn_alimentos.php");

$erro = "";
$sucesso = "";

if(isset($_POST['enviar'])){
    
    mysqli_select_db($conn_alimentos, $database_conn);

    // Captura dados do formulário
    $nome_usuario = trim($_POST['nome_usuario']);
    $email_usuario = trim($_POST['email_usuario']);
    $login_usuario = trim($_POST['login_usuario']);
    $senha_usuario = trim($_POST['senha_usuario']);
    $tipo_usuario = trim($_POST['tipo_usuario']);

    // Validações básicas
    if(empty($nome_usuario) || empty($email_usuario) || empty($login_usuario) || empty($senha_usuario) || empty($tipo_usuario)){
        $erro = "Todos os campos são obrigatórios.";
    } elseif(!filter_var($email_usuario, FILTER_VALIDATE_EMAIL)){
        $erro = "E-mail inválido.";
    } else {
        // Verifica se email já existe
        $stmt_busca = $conn_alimentos->prepare("SELECT id_usuario FROM tbusuarios WHERE email_usuario = ?");
        $stmt_busca->bind_param("s", $email_usuario);
        $stmt_busca->execute();
        $resultado_busca = $stmt_busca->get_result();

        if($resultado_busca->num_rows > 0){
            $erro = "Este e-mail já está cadastrado! Tente outro.";
        } else {
            // Verifica se login já existe
            $stmt_busca_login = $conn_alimentos->prepare("SELECT id_usuario FROM tbusuarios WHERE login_usuario = ?");
            $stmt_busca_login->bind_param("s", $login_usuario);
            $stmt_busca_login->execute();
            $resultado_busca_login = $stmt_busca_login->get_result();

            if($resultado_busca_login->num_rows > 0){
                $erro = "Este login já está em uso! Escolha outro.";
            } else {
                // Processa foto
                $nome_img = "sem_imagem.jpg"; 
                
                if(isset($_FILES['foto_usuario']) && $_FILES['foto_usuario']['error'] === 0){
                    $nome_arquivo = $_FILES['foto_usuario']['name'];
                    $tmp_arquivo = $_FILES['foto_usuario']['tmp_name'];
                    $tamanho_arquivo = $_FILES['foto_usuario']['size'];
                    $tipo_arquivo = $_FILES['foto_usuario']['type'];

                    // Validações de imagem
                    $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif'];
                    $extensao = strtolower(pathinfo($nome_arquivo, PATHINFO_EXTENSION));
                    
                    if(!in_array($extensao, $extensoes_permitidas)){
                        $erro = "Formato de imagem não permitido. Use: jpg, jpeg, png ou gif.";
                    } elseif($tamanho_arquivo > 5242880){ // 5MB
                        $erro = "A imagem deve ter no máximo 5MB.";
                    } else {
                        // Cria nome único para arquivo
                        $nome_img = uniqid("user_") . "." . $extensao;
                        $dir_img = "../imagens/" . $nome_img;
                        
                        if(!move_uploaded_file($tmp_arquivo, $dir_img)){
                            $erro = "Erro ao fazer upload da imagem.";
                            $nome_img = "sem_imagem.jpg";
                        }
                    }
                }

                // Se não houve erro com a imagem, insere o usuário
                if(empty($erro)){
                    $stmt_insert = $conn_alimentos->prepare("INSERT INTO tbusuarios 
                        (nome_usuario, email_usuario, login_usuario, senha_usuario, tipo_usuario, foto_usuario) 
                        VALUES (?, ?, ?, ?, ?, ?)");
                    
                    $stmt_insert->bind_param("ssssss", $nome_usuario, $email_usuario, $login_usuario, $senha_usuario, $tipo_usuario, $nome_img);
                    
                    if($stmt_insert->execute()){
                        $sucesso = "Usuário cadastrado com sucesso!";
                        echo "<script>
                                alert('Usuário cadastrado com sucesso!');
                                window.location.href = 'usuario_lista.php';
                              </script>";
                        exit;
                    } else {
                        $erro = "Erro ao inserir usuário: " . $stmt_insert->error;
                    }
                    $stmt_insert->close();
                }
            }
            $stmt_busca_login->close();
        }
        $stmt_busca->close();
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
                    <?php if(!empty($erro)): ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>Erro!</strong> <?= htmlspecialchars($erro) ?>
                        </div>
                    <?php endif; ?>
                    <div class="alert alert-success" role="alert">
                        <form action="" method="POST" enctype="multipart/form-data" name="form_usuario" id="form_usuario">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados Pessoais</h3>
                                    <div class="form-group">
                                        <label for="nome_usuario" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome_usuario" name="nome_usuario" placeholder="Digite o nome completo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email_usuario" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email_usuario" name="email_usuario" placeholder="seuemail@exemplo.com" required>
                                    </div>
                                    <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="foto_usuario">Foto do usuário</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-picture"></span>
                                            </span>
                                            <input type="file" name="foto_usuario" id="foto_usuario" class="form-control" accept="image/*">
                                        </div>
                                        <br>
                                        <img src="" alt="" id="imagem" class="img-responsive center-block" style="max-height: 200px; display:none; border: 1px solid #ccc; padding: 5px;">
                                    </div> 
                                </div>
                            </div>
                                </div>
                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados de Acesso</h3>
                                    <div class="form-group">
                                        <label for="login_usuario" class="form-label">Login (Nome de Usuário)</label>
                                        <input type="text" class="form-control" id="login_usuario" name="login_usuario" placeholder="Ex: admin.sistema" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="senha_usuario" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="senha_usuario" name="senha_usuario" placeholder="Digite uma senha segura" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_usuario" class="form-label">Nível de Acesso</label>
                                        <select class="form-control" name="tipo_usuario" id="tipo_usuario" required>
                                            <option value="" disabled selected>Selecione o nível</option>
                                            <option value="Admin">Admin</option> 
                                            <option value="User">User</option>   
                                        </select>
                                    </div>
                                </div>
                            </div> 
                            
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <input type="submit" value="Cadastrar Usuário" name="enviar" id="enviar" class="btn btn-success btn-block">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("foto_usuario").onchange = function(){
            var reader = new FileReader();
            if(this.files[0].size > 5242880){
                alert("A imagem deve ter no máximo 5MB.");
                $("#imagem").hide();
                $("#foto_usuario").wrap('<form>').closest('form').get(0).reset();
                $("#foto_usuario").unwrap();
                return false;
            }
            if(this.files[0].type.indexOf("image") == -1){
                alert("Formato inválido, escolha uma imagem.");
                $("#imagem").hide();
                $("#foto_usuario").wrap('<form>').closest('form').get(0).reset();
                $("#foto_usuario").unwrap();
                return false;
            }
            reader.onload = function(e){
                document.getElementById("imagem").src = e.target.result;
                $("#imagem").show();
            };
            reader.readAsDataURL(this.files[0]);
        };
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>