<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Doação - Desperdício Zero</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    
    <style>
        /* Estilo customizado (opcional) */
        body {
            background-color: #f9f9f9; /* Um fundo leve */
            padding-top: 40px; /* Espaço do topo */
        }
        .brand-logo {
            font-size: 3rem; /* Aumentei um pouco */
            color: #28a745; /* Verde */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">

                <div class="text-center">
                    <span class="brand-logo">🌱</span>
                    <h2>Cadastrar Nova Doação</h2>
                    <p class="lead">Compartilhe o que sobra. Alimente quem precisa.</p>
                </div>

                <hr>

                <form action="processar_cadastro.php" method="POST" role="form">

                    <div class="form-group">
                        <label for="nome_doador">Seu Nome ou Nome da Empresa</label>
                        <input type="text" class="form-control" id="nome_doador" name="nome_doador" placeholder="Ex: Restaurante Sabor da Casa" required>
                    </div>

                    <div class="form-group">
                        <label for="tipo_alimento">Tipo de Alimento</label>
                        <select class="form-control" id="tipo_alimento" name="tipo_alimento" required>
                            <option value="" selected disabled>Selecione uma categoria</option>
                            <option value="Frutas">Frutas</option>
                            <option value="Legumes/Verduras">Legumes e Verduras</option>
                            <option value="Pães e Massas">Pães e Massas</option>
                            <option value="Marmitas/Pratos Prontos">Marmitas / Pratos Prontos</option>
                            <option value="Laticínios">Laticínios</option>
                            <option value="Alimentos não perecíveis">Alimentos não perecíveis (Arroz, Feijão, etc.)</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantidade">Quantidade Disponível</label>
                        <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Ex: 5 kg, 10 unidades, 3 caixas" required>
                    </div>

                    <div class="form-group">
                        <label for="validade">Data de Validade / Disponibilidade</label>
                        <input type="date" class="form-control" id="validade" name="validade" required>
                    </div>

                    <div class="form-group">
                        <label for="endereco">Endereço para Retirada</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua, Número, Bairro, Cidade" required>
                    </div>

                    <div class="form-group">
                        <label for="contato">Contato (Telefone ou WhatsApp)</label>
                        <input type="tel" class="form-control" id="contato" name="contato" placeholder="(XX) 9XXXX-XXXX" required>
                    </div>

                    <input type="hidden" name="status" value="disponível">

                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        Publicar Doação
                    </button>

                </form>
                <br> </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>