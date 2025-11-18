<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Doação - Desperdício Zero</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <style>
        /* Estilo customizado */
        .brand-logo {
            font-size: 3rem; 
            color: #198754; /* Verde do Bootstrap (btn-success) */
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9">
                
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <span class="brand-logo">🌱</span>
                            <h2>Cadastrar Nova Doação</h2>
                            <p class="lead">Compartilhe o que sobra. Alimente quem precisa.</p>
                        </div>

                        <hr class="mb-4">

                        <form action="processar_cadastro.php" method="POST">

                            <div class="mb-3">
                                <label for="nome_doador" class="form-label">Seu Nome ou Nome da Empresa</label>
                                <input type="text" class="form-control" id="nome_doador" name="nome_doador" placeholder="Ex: Restaurante Sabor da Casa" required>
                            </div>

                            <div class="mb-3">
                                <label for="tipo_alimento" class="form-label">Tipo de Alimento</label>
                                <select class="form-select" id="tipo_alimento" name="tipo_alimento" required>
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

                            <div class="mb-3">
                                <label for="alimento_especifico" class="form-label">Alimento Específico</label>
                                <input type="text" class="form-control" id="alimento_especifico" name="alimento_especifico" placeholder="Ex: Maçã, Arroz, Pão Francês" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quantidade" class="form-label">Quantidade Disponível</label>
                                    <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Ex: 5 kg, 10 unidades" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validade" class="form-label">Data de Validade / Disponibilidade</label>
                                    <input type="date" class="form-control" id="validade" name="validade" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="endereco" class="form-label">Endereço para Retirada</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua, Número, Bairro, Cidade" required>
                            </div>

                            <div class="mb-3">
                                <label for="contato" class="form-label">Contato (Telefone ou WhatsApp)</label>
                                <input type="tel" class="form-control" id="contato" name="contato" placeholder="(XX) 9XXXX-XXXX" required>
                            </div>

                            <div class="mb-3">
                                <label for="observacoes" class="form-label">Observações (Opcional)</label>
                                <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Ex: Precisa de refrigeração, retirar até as 17h, contém glúten..."></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                    <label for="doacao_criada" class="form-label">Data de criação da Doação</label>
                                    <input type="date" class="form-control" id="doacao_criada" name="validade" required>
                                </div>

                            <input type="hidden" name="status" value="disponível">
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-lg">
                                    Publicar Doação
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>