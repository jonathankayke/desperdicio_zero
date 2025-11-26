<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Doações - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-success">🌱 Doações Cadastradas</h2>
            <a href="index.php" class="btn btn-outline-secondary">Voltar</a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle">
                        <thead class="table-success">
                            <tr>
                                <th>#</th> <th>Doador</th>
                                <th>Alimento</th>
                                <th>Qtd.</th>
                                <th>Validade</th>
                                <th>Local / Contato</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>1</td> <td class="fw-bold">Restaurante Sabor</td> <td>
                                    <span class="badge bg-secondary">Frutas</span><br>
                                    <small>Maçãs</small>
                                </td>
                                
                                <td>10 kg</td> <td>30/12/2024</td> <td>
                                    <small>📍 Rua das Flores, 123</small><br>
                                    <small>📞 (11) 99999-9999</small>
                                </td>

                                <td>
                                    <span class="badge bg-success">Disponível</span>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td class="fw-bold">Padaria Central</td>
                                <td>
                                    <span class="badge bg-secondary">Pães e Massas</span><br>
                                    <small>Pão Francês</small>
                                </td>
                                <td>50 un</td>
                                <td>28/12/2024</td>
                                <td>
                                    <small>📍 Av. Paulista, 500</small><br>
                                    <small>📞 (11) 98888-8888</small>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">Entregue</span>
                                </td>
                            </tr>

                            </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>