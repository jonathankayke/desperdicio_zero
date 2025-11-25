<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Cadastro Usuários</title>
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card shadow border-0 p-4">
            <div class="text-center mb-3">
                <span class="font-size: 3rem;">🌿</span>
                <h3 class="text-success fw-bold">Cadastrar</h3>
                <form action="cadastro_usuarios.php" enctype >
                    <div class="mb-3">
                        <label class="form-label">E-mail:</label>
                        <input type="email" class="form-control" name="email_cadastro" placeholder="seu@email.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Senha:</label>
                        <input type="password" class="form-control" name="senha_cadastro" placeholder="********" required>
                    </div>

                    <div class="mb-3">
                        <label for="tipo_cadastro">Tipo cadastro?</label>
                        <div class="input-group">
                            <label for="tipo_usuario_b" class="radio-inline">
                                <input type="radio" name="tipo_usuario_" id="tipo_usuario_b" value="ben">
                                Beneficiário
                            </label>
                            <label for="tipo_usuario_d" class="radio-inline">
                                <input type="radio" name="tipo_usuario_" id="tipo_usuario_d" value="doa" checked>
                                Doador
                            </label>
                        </div>
                         <!-- fecha tipo usuario -->
                        <br>

                        <input type="submit" value="Cadastrar" name="enviar" id="enviar" class="btn btn-info btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>