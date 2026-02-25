<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");

// Consulta para trazer os dados e SE necessário filtrar
$tabela = "vw_doacoes";
$ordenar_por = "rotulo_tipo ASC";
$consulta = "
                    SELECT  *
                    FROM    " . $tabela . "
                    ORDER BY " . $ordenar_por . ";
                    ";
$lista = $conn_alimentos->query($consulta);
$row = $lista->fetch_assoc();
$totalRows = ($lista)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doações por Tipo</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>

<body class="fundofixo">
    <!-- MENU -->
    <?php include('menu_publico.php'); ?>
    <main class="container">
        <!-- CARROUSSEL -->
        <?php //include('carroussel.php'); ?>

        <h2 class="breadcrumb alert-success">
            <a href="javascript:window.history.go(-1)" class="btn btn-success">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            Todos
        </h2>

        <?php
        // Variável para controlar o grupo atual
        $tipo_atual = "";
        if ($totalRows > 0) {  // Verifica se há produtos para exibir
            do {
                // Se o id_tipo_produto atual for diferente do anterior, cria um novo grupo
                if ($tipo_atual != $row['id_doacao_tipo']) {
                    // Se não for o primeiro grupo, fecha row anterior
                    if ($tipo_atual != "") {
                        echo '</div>';
                    }
                    // Atualizar $tipo_atual e exibe o novo cabeçalho do grupo
                    $tipo_atual = $row['id_doacao_tipo'];
                    echo '<h2 class="tipo">' . $row['rotulo_tipo'] . '</h2>';
                    // Abre uma nova div row para os produtos deste grupo
                    echo '<div class="row"> <!-- manter os elementos na linha (poliça) -->';
                }
                ?>
                <!-- Abre thumbnail/card -->
                <div class="lista-wrapper borda-verde">
                    <div class="row" style="display: flex; align-items: center; flex-wrap: wrap;">

                        <div class="col-sm-2">
                            <img src="imagens/<?php echo $row['imagem_doacao']; ?>" class="img-responsive img-rounded"
                                style="max-height: 100px; border: 1px solid #eee; padding: 5px; width: 100%;">
                        </div>

                        <div class="col-sm-2">
                            <h3 style="color: #2cc960ff; margin: 0; font-weight: bold;">
                                <?php echo $row['nome_alimento']; ?>
                            </h3>
                        </div>

                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <span class="label-info-custom">Tipo</span>
                                    <span class="valor-info-custom"><?php echo $row['rotulo_tipo']; ?></span>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <span class="label-info-custom">Qtd</span>
                                    <span class="valor-info-custom"><?php echo $row['quantidade_doacao']; ?></span>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <span class="label-info-custom">Validade</span>
                                    <span
                                        class="valor-info-custom"><?php echo date('d/m/Y', strtotime($row['validade_doacao'])); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-2 text-right">
                            <p style="font-size: 0.9em; margin-bottom: 10px;">
                                <i class="glyphicon glyphicon-briefcase"></i> <?php echo $row['nome_empresa']; ?>
                            </p>
                            <a href="doacao_detalhe.php?id_doacao=<?php echo $row['id_doacao']; ?>">   
                            <button type="button"
                                        class="btn btn-block shadow-sm fundoverde-padrao" style="border-radius: 15px; font-weight: 600; letter-spacing: 0.5px;" 
                                    >
                                    Ver detalhes
                            </button>
                        </a>
                        </div>
                    </div>
                </div> <!-- fecha dimensionamento -->
            <?php
            } while ($row = $lista->fetch_assoc());

            // é importante fechar a última div row que ficou aberta após o loop
            echo '</div> <!-- fecha row -->';
        } else {
            // Mensagem caso não haja produtos
            echo '<div class="alert-warning" role="alert">Nenhum produto encontrado.</div>';
        }
        ?>
        <!-- RODAPÉ -->
        <footer>
            <?php include('rodape.php'); ?>
            <a name="contato"></a>
        </footer>
    </main>
    <!-- Link arquivos Bootstrap js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
<?php mysqli_free_result($lista); ?>