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

                <h1 class="text-center" style="color:white; text-shadow:1px 1px 3px rgba(0,0,0,0.5); margin-bottom:20px;">
                    Atualização de Usuário
                </h1>

                <div class="thumbnail" style="border:none; background:none;">
                    <div class="alert alert-success" role="alert">

                        <form action="usuario_atualiza.php" method="POST" enctype="multipart/form-data">

                            <!-- ID oculto -->
                            <input type="hidden" name="id_usuario" value="<?=$dados['id_usuario']?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados Pessoais</h3>

                                    <div class="form-group">
                                        <label for="nome_usuario">Nome Completo</label>
                                        <input type="text" class="form-control" id="nome_usuario" 
                                               name="nome_usuario" required
                                               value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="email_usuario">E-mail</label>
                                        <input type="email" class="form-control" id="email_usuario" 
                                               name="email_usuario" required
                                               value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="fone_usuario">Telefone</label>
                                        <input type="tel" class="form-control" id="fone_usuario" 
                                               name="fone_usuario"
                                               value="">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados de Acesso</h3>

                                    <div class="form-group">
                                        <label for="login_usuario">Login</label>
                                        <input type="text" class="form-control" id="login_usuario" 
                                               name="login_usuario" required
                                               value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="senha_usuario">Senha (deixe em branco para manter a atual)</label>
                                        <input type="password" class="form-control" id="senha_usuario" 
                                               name="senha_usuario" placeholder="Digite apenas se quiser alterar">
                                    </div>

                                    <div class="form-group">
                                        <label for="nivel_usuario">Nível de Acesso</label>
                                        <select class="form-control" name="nivel_usuario" id="nivel_usuario" required>
                                            <option value="sup" >Supervisor</option>
                                            <option value="com" >Comum</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Imagem Atual</label><br>
                                    
                                    <img src="../imagens/usuarios/<?=$dados['imagem']?>"
                                         class="img-responsive"
                                         style="max-height: 250px; border:2px solid #ccc;">

                                    <br><br>

                                    <label for="imagem_produto">Nova Imagem (opcional)</label>
                                    <input type="file" name="imagem_produto" id="imagem_produto" 
                                           class="form-control" accept="image/*">

                                    <img id="imagem" src="" alt="" class="img-responsive" 
                                         style="max-height: 250px; margin-top:15px; display:none;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        <span class="glyphicon glyphicon-refresh"></span> Atualizar Usuário
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Script da imagem -->
    <script>
        document.getElementById("imagem_produto").onchange = function () {
            var reader = new FileReader();

            if (this.files[0].size > 512000) {
                alert("A imagem deve ter no máximo 500kb.");
                $("#imagem").hide().attr("src", "");
                this.value = "";
                return false;
            }

            if (this.files[0].type.indexOf("image") === -1) {
                alert("Formato inválido, escolha uma imagem.");
                $("#imagem").hide().attr("src", "");
                this.value = "";
                return false;
            }

            reader.onload = function (e) {
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
