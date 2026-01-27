<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos,$database_conn);

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbusuarios";
    $campos_insert  =   "
                            nome_usuario,
                            email_usuario,
                            telefone_usuario,
                            login_usuario,
                            senha_usuario,
                            tipo_usuario,
                            foto_usuario
                        ";

    // Guardar o nome da imagem no banco e o arquivo no diretório
    if(isset($_POST['enviar'])){
        $nome_img   =   $_FILES['imagem_produto']['name'];
        $tmp_img    =   $_FILES['imagem_produto']['tmp_name'];
        $dir_img    =   "../imagens/".$nome_img;
        move_uploaded_file($tmp_img,$dir_img);
    };

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_tipo_produto    =   $_POST['id_tipo_produto'];
    $destaque_produto   =   $_POST['destaque_produto'];
    $descri_produto     =   $_POST['descri_produto'];
    $resumo_produto     =   $_POST['resumo_produto'];     
    $valor_produto      =   $_POST['valor_produto'];
    $imagem_produto     =   $_FILES['imagem_produto']['name'];

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$id_tipo_produto',
                        '$destaque_produto',
                        '$descri_produto',
                        '$resumo_produto',
                        '$valor_produto',
                        '$imagem_produto'
                        ";

    // Consulta SQL para inserção dos dados
    $insertSQL  =   "
                    INSERT INTO ".$tabela_insert."
                        (".$campos_insert.")
                    VALUES
                        (".$valores_insert.");
                    ";
    $resultado  =   $conn_alimentos->query($insertSQL);

    // Após a ação a página será redirecionada
    $destino    =   "produtos_lista.php";
    if(mysqli_insert_id($conn_alimentos)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

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
                        
                        <form action="usuario_insere.php" method="POST" name="form_usuario" id="form_usuario">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados Pessoais</h3>

                                    <div class="form-group">
                                        <label for="nome_usuario" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome_usuario" name="nome_usuario"
                                            placeholder="Digite o nome completo" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="login_usuario" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="login_usuario" name="login_usuario"
                                            placeholder="seuemail@exemplo.com" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="fone_usuario" class="form-label">Telefone (Opcional)</label>
                                        <input type="tel" class="form-control" id="fone_usuario" name="fone_usuario"
                                            placeholder="(XX) 9XXXX-XXXX">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados de Acesso</h3>

                                    <div class="form-group">
                                        <label for="login_usuario" class="form-label">Login (Nome de Usuário)</label>
                                        <input type="text" class="form-control" id="login_usuario" name="login_usuario"
                                            placeholder="Ex: admin.sistema" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="senha_usuario" class="form-label">Senha</label>
                                        <input type="password" class="form-control" id="senha_usuario" name="senha_usuario"
                                            placeholder="Digite uma senha segura" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo_usuario" class="form-label">Nível de Acesso</label>
                                        <select class="form-control" name="tipo_usuario" id="tipo_usuario" required>
                                            <option value="" disabled selected>Selecione o nível</option>
                                            <option value="sup">Supervisor</option>
                                            <option value="com">Comum</option>
                                        </select>
                                    </div>
                                </div>
                                  <div class=" form-group">
                                    <label for="imagem_produto">Imagem</label>
                                    
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-picture"></span>
                                        </span>
                                        <!-- Exibir a imagem a ser inserida -->
                                        <img 
                                            src="" 
                                            alt=""
                                            name="imagem"
                                            id="imagem"
                                            class="img-responsive"
                                            style="max-height: 1100px;"
                                        >
                                        <input 
                                            type="file" 
                                            name="imagem_produto" 
                                            id="imagem_produto"
                                            class="form-control"
                                            accept="image/*"
                                        >
                                    </div> 
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <input 
                                        type="submit" 
                                        value="Cadastrar Usuário"
                                        name="enviar"
                                        id="enviar"
                                        class="btn btn-success btn-block"
                                    >
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <!-- Script para a imagem -->
    <script>
        document.getElementById("imagem_produto").onchange = function(){
        var reader = new FileReader();
        if(this.files[0].size>512000){
            alert("A imagem deve ter no máximo 500kb.");
            $("#imagem").attr("src","blank");
            $("#imagem").hide();
            $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
            $("#imagem_produto").unwrap();
            return false;
        }
        if(this.files[0].type.indexOf("image")==-1){
            alert("Formato inválido, escolha uma imagem.");
            $("#imagem").attr("src","blank");
            $("#imagem").hide();
            $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
            $("#imagem_produto").unwrap();
            return false;
        }
        reader.onload = function(e){
            // obter dados carregados e renderizar uma miniatura.
            document.getElementById("imagem").src = e.target.result;
            $("imagem").show();
        };
        // leia o arquivo de imagem como um URL de dados.
        reader.readAsDataURL(this.files[0]);
        };
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>