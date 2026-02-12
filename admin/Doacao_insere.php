<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

// Lógica de Inserção
if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos, $database_conn);

    $tabela_insert  =   "tbdoacoes";
    $campos_insert  =   "id_doacao_tipo, nome_empresa, contato_doacao, tipo_alimento, nome_alimento, quantidade_doacao, validade_doacao, endereco_retirada, imagem_doacao";

    // Upload da Imagem
    $nome_img = "sem_imagem.jpg"; // Valor padrão caso não envie imagem
    if(isset($_FILES['imagem_doacao']) && $_FILES['imagem_doacao']['error'] === 0){
        $nome_img   =   $_FILES['imagem_doacao']['name'];
        $tmp_img    =   $_FILES['imagem_doacao']['tmp_name'];
        $dir_img    =   "../imagens/".$nome_img;
        move_uploaded_file($tmp_img, $dir_img);
    }

    // Recebendo dados
    $id_doacao_tipo     =   $_POST['id_doacao_tipo'];
    $nome_empresa       =   $_POST['nome_empresa'];
    $contato_doacao     =   $_POST['contato_doacao'];
    // $tipo_alimento será pego via consulta SQL abaixo
    $nome_alimento      =   $_POST['nome_alimento'];
    $quantidade_doacao  =   $_POST['quantidade_doacao'];
    $validade_doacao    =   $_POST['validade_doacao'];
    $endereco_retirada  =   $_POST['endereco_retirada'];
    $imagem_doacao      =   $nome_img;

    // Buscar a sigla do tipo baseado no ID selecionado
    $query_sigla    = "SELECT sigla_tipo FROM tbtipos WHERE id_tipo = $id_doacao_tipo";
    $result_sigla   = $conn_alimentos->query($query_sigla);
    $row_sigla      = $result_sigla->fetch_assoc();
    $tipo_alimento  = $row_sigla['sigla_tipo'];

    // Montar valores
    $valores_insert =   "'$id_doacao_tipo', '$nome_empresa', '$contato_doacao', '$tipo_alimento', '$nome_alimento', '$quantidade_doacao', '$validade_doacao', '$endereco_retirada', '$imagem_doacao'";

    // Consulta SQL
    $insertSQL  =   "INSERT INTO ".$tabela_insert." (".$campos_insert.") VALUES (".$valores_insert.");";
    $resultado  =   $conn_alimentos->query($insertSQL);

    // Redirecionamento
    $destino    =   "doacao_lista.php";
    if(mysqli_insert_id($conn_alimentos)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

// Selecionar Tipos para o Dropdown
mysqli_select_db($conn_alimentos,$database_conn);
$tabela_fk      =   "tbtipos";
$ordenar_por    =   "rotulo_tipo ASC";
$consulta_fk    =   "SELECT * FROM ".$tabela_fk." ORDER BY ".$ordenar_por.";";
$lista_fk       =   $conn_alimentos->query($consulta_fk);
$row_fk         =   $lista_fk->fetch_assoc();
$totalRows_fk   =   ($lista_fk)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Doação</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">

    <style>
       
    </style>
</head>

<body class="fundofixo">

<?php include("menu_adm.php") ?>

<main class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            
            <div class="panel panel-default panel-custom-verde">
                
                <div class="panel-heading panel-heading-verde text-center">
                    <h3 style="margin: 0; font-weight: bold;">
                        <i class="fa-solid fa-basket-shopping"></i> Cadastro de Doação
                    </h3>
                </div>

                <div class="panel-body" style="padding: 30px;">
                    <form action="" method="POST" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="secao-form">Dados do Doador</h4>

                                <div class="form-group">
                                    <label for="nome_empresa">Nome da Empresa/Doador</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-building"></i></span>
                                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" placeholder="Ex: Restaurante Sabor" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="contato_doacao">Contato (WhatsApp)</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-brands fa-whatsapp"></i></span>
                                        <input type="tel" class="form-control" id="contato_doacao" name="contato_doacao" placeholder="(XX) 9XXXX-XXXX" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="endereco_retirada">Endereço para Retirada</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-map-location-dot"></i></span>
                                        <input type="text" class="form-control" id="endereco_retirada" name="endereco_retirada" placeholder="Rua, Número, Bairro" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <h4 class="secao-form">Detalhes do Alimento</h4>

                                <div class="form-group">
                                    <label for="id_doacao_tipo">Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-list"></i></span>
                                        <select class="form-control" id="id_doacao_tipo" name="id_doacao_tipo" required>
                                            <option value="" selected disabled>Selecione uma categoria...</option>
                                            <?php do { ?>
                                                <option value="<?php echo $row_fk['id_tipo']; ?>">
                                                    <?php echo $row_fk['rotulo_tipo']; ?>
                                                </option>
                                            <?php } while ($row_fk = $lista_fk->fetch_assoc()); ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nome_alimento">Nome do Alimento</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa-solid fa-bowl-food"></i></span>
                                        <input type="text" class="form-control" id="nome_alimento" name="nome_alimento" placeholder="Ex: Maçã Fuji, Pães" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="quantidade_doacao">Quantidade</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-weight-hanging"></i></span>
                                            <input type="text" class="form-control" id="quantidade_doacao" name="quantidade_doacao" placeholder="Ex: 5 kg" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="validade_doacao">Validade</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-calendar-days"></i></span>
                                            <input type="date" class="form-control" id="validade_doacao" name="validade_doacao" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="imagem_doacao">Foto da Doação</label>
                                    <div class="well text-center" style="margin-bottom: 0; background-color: white;">
                                        <img src="../imagens/sem_imagem.jpg" alt="Preview" id="imagem_preview" class="img-responsive center-block" style="max-height: 150px; margin-bottom: 10px; border-radius: 5px; display: none;">
                                        
                                        <input type="file" name="imagem_doacao" id="imagem_doacao" class="form-control" accept="image/*">
                                        <small class="text-muted">Max: 5MB (JPG/PNG)</small>
                                    </div>
                                </div> 
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-6">
                                <a href="doacao_lista.php" class="btn btn-default btn-block btn-lg">
                                    <i class="fa-solid fa-arrow-left"></i> Voltar
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <button type="submit" name="enviar" class="btn btn-salvar-verde btn-block btn-lg">
                                    <i class="fa-solid fa-check"></i> Salvar Doação
                                </button>
                            </div>
                        </div>

                    </form>
                </div> </div> </div>
    </div>
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
    document.getElementById("imagem_doacao").onchange = function(){
        var reader = new FileReader();
        
        // Validação de Tamanho
        if(this.files[0].size > 5242880){
            alert("A imagem deve ter no máximo 5MB.");
            $("#imagem_preview").hide();
            $(this).val(''); // Limpa o input
            return false;
        }
        
        // Validação de Tipo
        if(this.files[0].type.indexOf("image") == -1){
            alert("Formato inválido, escolha uma imagem.");
            $("#imagem_preview").hide();
            $(this).val(''); // Limpa o input
            return false;
        }
        
        reader.onload = function(e){
            // Exibe a imagem no elemento correto (imagem_preview)
            document.getElementById("imagem_preview").src = e.target.result;
            $("#imagem_preview").show();
        };
        
        reader.readAsDataURL(this.files[0]);
    };
</script>

</body>
</html>
<?php
// Limpar memória da consulta de tipos
mysqli_free_result($lista_fk);
?>