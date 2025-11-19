<?php
session_start();

// 1. Ajuste o caminho se necessário. Aqui assume-se que estão na mesma pasta.
require_once "../Connections/conn_alimentos.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    try {
        // 2. Prepara a query usando PDO
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        
        // 3. Vincula o parâmetro e executa de uma vez
        $stmt->execute([':email' => $email]);
        
        // 4. Busca o usuário (fetch)
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se achou o usuário
        if ($user) {
            // 5. Verifica a senha (HASH)
            // IMPORTANTE: Isso só funciona se a senha no banco foi salva usando password_hash()
            if (password_verify($senha, $user["senha"])) {
                
                // Salva dados na sessão
                $_SESSION["usuario_id"] = $user["id"];
                $_SESSION["usuario_nome"] = $user["nome"];
                $_SESSION["usuario_tipo"] = $user["tipo"];

                // Redirecionamento baseado no nível de acesso
                if ($user["tipo"] == "admin") {
                    header("Location: admin/index.php");
                } else {
                    header("Location: painel/index.php"); // ou index.php
                }
                exit;
            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "E-mail não encontrado.";
        }

    } catch (PDOException $e) {
        $erro = "Erro no sistema: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Desperdício Zero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow border-0 p-4" style="max-width: 400px; width: 100%;">
        
        <div class="text-center mb-3">
            <span style="font-size: 3rem;">🌱</span>
            <h3 class="text-success fw-bold">Entrar</h3>
        </div>

        <?php if (isset($erro)): ?>
            <div class="alert alert-danger text-center"><?= $erro ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" placeholder="seu@email.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" placeholder="********" required>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Entrar</button>
            </div>
            
            <div class="text-center mt-3">
                <a href="cadastro_usuario.php" class="text-decoration-none">Não tem conta? Criar conta</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>