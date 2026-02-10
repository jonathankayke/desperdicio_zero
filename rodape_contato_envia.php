<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Redireciona após 15 segundos -->
    <meta http-equiv="refresh" content="15;URL=indexfake.php">
    <title>Contato - Desperdício Zero</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo">

<?php include('menu_publico.php'); ?>

<main class="container">
    <section>
        <div class="jumbotron alert-success">
            <h1>Agradecemos seu contato!</h1>

            <?php
                /* ===== DADOS RECEBIDOS DO FORMULÁRIO ===== */
                $destino        = "contato@desperdiciozero.com.br";
                $nome_contato   = $_POST['nome_contato'] ?? '';
                $email_contato  = $_POST['email_contato'] ?? '';
                $comentarios    = $_POST['comentarios_contato'] ?? '';

                /* ===== MENSAGEM ===== */
                $mensagem = "Contato recebido pelo site Desperdício Zero\n\n";
                $mensagem .= "Nome: $nome_contato\n";
                $mensagem .= "Email: $email_contato\n\n";
                $mensagem .= "Mensagem:\n$comentarios";

                /* ===== CABEÇALHOS ===== */
                $headers  = "From: $email_contato\r\n";
                $headers .= "Reply-To: $email_contato\r\n";
                $headers .= "Content-Type: text/plain; charset=UTF-8";

                /* ===== ENVIO (no XAMPP pode não enviar, mas não quebra) ===== */
                @mail($destino, "Contato - Desperdício Zero", $mensagem, $headers);
            ?>

            <div class="text-center">
                <p>
                    Obrigado por entrar em contato,
                    <strong><?php echo htmlspecialchars($nome_contato); ?></strong>!
                </p>

                <p>
                    Sua mensagem foi recebida com sucesso.
                </p>

                <h5>
                    Caso não receba retorno,
                    envie um e-mail para:
                    <br>
                    <strong>
                        <i><?php echo $destino; ?></i>
                    </strong>
                </h5>

                <p class="text-muted">
                    Você será redirecionado para a página inicial em instantes.
                </p>
            </div>
        </div>
    </section>
</main>

<footer>
    <?php include('rodape.php'); ?>
</footer>

<script src="js/bootstrap.min.js"></script>
</body>
</html>
