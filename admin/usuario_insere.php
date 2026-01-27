<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

if(isset($_POST['enviar'])){
    
    // Selecionar o banco de dados
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

   
    // Upload da Imagem
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
                                            <option value="Admin">Admin</option> <option value="User">User</option>   </select>
                                    </div>
                                </div>
                                  <div class=" form-group">
                                    <label for="foto_usuario">Imagem</label>
                                    
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-picture"></span>
                                        </span>
                                        <img src="" alt="" id="imagem" class="img-responsive" style="max-height: 200px; display:none;">
                                        
                                        <input type="file" name="foto_usuario" id="foto_usuario" class="form-control" accept="image/*">
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
            // Validação de Tamanho (5MB)
            if(this.files[0].size > 5242880){
                alert("A imagem deve ter no máximo 5MB.");
                $("#imagem").hide();
                $("#foto_usuario").wrap('<form>').closest('form').get(0).reset();
                $("#foto_usuario").unwrap();
                return false;
            }
            // Validação de Tipo
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