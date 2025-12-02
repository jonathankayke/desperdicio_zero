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
                                        <label for="email_usuario" class="form-label">E-mail</label>
                                        <input type="email" class="form-control" id="email_usuario" name="email_usuario"
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
                                        <label for="nivel_usuario" class="form-label">Nível de Acesso</label>
                                        <select class="form-control" name="nivel_usuario" id="nivel_usuario" required>
                                            <option value="" disabled selected>Selecione o nível</option>
                                            <option value="sup">Supervisor</option>
                                            <option value="com">Comum</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        <span class="glyphicon glyphicon-save"></span> Cadastrar Usuário
                                    </button>
                                </div>
                            </div>

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