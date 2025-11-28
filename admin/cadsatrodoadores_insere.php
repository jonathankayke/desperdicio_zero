<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4">

                <h1 class="text-center" style="color: white; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); margin-bottom: 20px;">
                    Cadastro
                </h1>

                <div class="thumbnail" style="border: none; background: none; box-shadow: none;">

                    <div class="alert alert-success" role="alert">
                        <form action="processar_cadastro.php" method="POST">

                            <div class="form-group">
                                <label for="nome_doador" class="form-label">Seu Nome/Nome da Empresa</label>
                                <input type="text" class="form-control" id="nome_doador" name="nome_doador"
                                    placeholder="Ex: Restaurante Sabor da Casa" required>
                            </div>

                            <div class="form-group">
                                <label for="tipo_instituicao" class="form-label">Tipo de Instituição</label>
                                <input type="text" class="form-control" id="tipo_instituicao" name="tipo_instituicao"
                                    placeholder="Ex: Mercado, Restaurante, Igreja, etc." required>
                            </div>

                            <div class="form-group">
                                <label for="endereco_empresa" class="form-label">Endereço da Empresa</label>
                                <input type="text" class="form-control" id="endereco_empresa" name="endereco_empresa"
                                    placeholder="Rua, Número, Bairro, Cidade" required>
                            </div>

                            <div class="form-group">
                                <label for="whatsapp" class="form-label">Contato (WhatsApp)</label>
                                <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                    placeholder="(XX) 9XXXX-XXXX" required>
                            </div>

                            <div class="form-group">
                                <label for="documento" class="form-label">CPF/CNPJ</label>
                                <input type="text" class="form-control" id="documento" name="documento"
                                    placeholder="CPF ou CNPJ" required>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="contato@gmail.com" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg btn-block">
                                    Salvar Cadastro
                                </button>
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