<?php
include("../Connections/conn_alimentos.php");

// Verifica ID recebido
if (!isset($_GET['id'])) {
    die("ID da doação não informado!");
}

$id = $_GET['id'];

// Consulta os dados da doação
$sql = $conn->prepare("SELECT * FROM tbdoacoes WHERE id_doacao = ?");
$sql->execute([$id]);
$doacao = $sql->fetch(PDO::FETCH_ASSOC);

if (!$doacao) {
    die("Doação não encontrada!");
}

// Buscar todos os tipos para o select
$sqlTipos = $conn->query("SELECT * FROM tbtipos ORDER BY rotulo_tipo");
$tipos = $sqlTipos->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Doação</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">

</head>

<body class="fundofixo">

<?php include("menu_adm.php"); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10">

            <h1 class="text-center text-white mb-4">
                Atualizar Doação
            </h1>

            <div class="card shadow-lg">
                <div class="card-body">

                    <!-- Formulário para atualização -->
                    <form action="atualizar_cadastro.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">

                        <div class="row">

                            <!-- DADOS DO DOADOR -->
                            <div class="col-md-6">
                                <h4 class="mb-3">Dados do Doador</h4>

                                <div class="mb-3">
                                    <label class="form-label">Nome / Empresa</label>
                                    <input type="text" class="form-control" name="nome_doador"
                                        value="<?= $dados['nome_doador'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tipo de Instituição</label>
                                    <input type="text" class="form-control" name="tipo_instituicao"
                                        value="<?= $dados['tipo_instituicao'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Endereço da Empresa</label>
                                    <input type="text" class="form-control" name="endereco_empresa"
                                        value="<?= $dados['endereco_empresa'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">WhatsApp</label>
                                    <input type="tel" class="form-control" name="whatsapp"
                                        value="<?= $dados['whatsapp'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">CPF / CNPJ</label>
                                    <input type="text" class="form-control" name="documento"
                                        value="<?= $dados['documento'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control" name="email"
                                        value="<?= $dados['email'] ?>" required>
                                </div>
                            </div>

                            <!-- DADOS DA DOAÇÃO -->
                            <div class="col-md-6">
                                <h4 class="mb-3">Dados da Doação</h4>

                                <div class="mb-3">
                                    <label class="form-label">Tipo de Alimento</label>
                                    <select class="form-select" name="tipo_alimento" required>
                                        <option disabled>Selecione...</option>

                                        <?php
                                        $categorias = ["Frutas", "Legumes", "Pães", "Carnes", "Bebidas", "Outros"];
                                        foreach ($categorias as $cat) {
                                            $sel = ($dados['tipo_alimento'] == $cat) ? "selected" : "";
                                            echo "<option value='$cat' $sel>$cat</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alimento Específico</label>
                                    <input type="text" class="form-control" name="alimento_especifico"
                                        value="<?= $dados['alimento_especifico'] ?>" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Quantidade</label>
                                        <input type="text" class="form-control" name="quantidade"
                                            value="<?= $dados['quantidade'] ?>" required>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Validade</label>
                                        <input type="date" class="form-control" name="validade"
                                            value="<?= $dados['validade'] ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Endereço para Retirada</label>
                                    <input type="text" class="form-control" name="endereco"
                                        value="<?= $dados['endereco'] ?>" required>
                                </div>

                                <!-- IMAGEM ATUAL -->
                                <div class="mb-3">
                                    <label class="form-label">Imagem Atual</label><br>
                                    <?php if (!empty($dados['imagem'])): ?>
                                        <img src="../imagens/<?= $dados['imagem'] ?>" class="img-fluid mb-2" style="max-height: 250px;">
                                    <?php else: ?>
                                        <p class="text-muted">Nenhuma imagem cadastrada.</p>
                                    <?php endif; ?>

                                    <label class="form-label">Alterar Imagem</label>
                                    <input type="file" class="form-control" name="imagem_produto" accept="image/*">
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Atualizar</button>
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
