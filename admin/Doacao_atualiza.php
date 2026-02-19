<?php
// Incluindo o Sistema de autenticação
include("acesso_user.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

// =============================
// PEGAR ID DA DOAÇÃO
// =============================
$id_doacao = isset($_GET['id_doacao']) ? $_GET['id_doacao'] : 0;

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos, $database_conn);

    if(isset($_POST['enviar'])){
        if(!empty($_FILES['imagem_doacao']['name'])){
            $nome_img   = $_FILES['imagem_doacao']['name'];
            $tmp_img    = $_FILES['imagem_doacao']['tmp_name'];
            $dir_img    = "../imagens/".$nome_img;
            move_uploaded_file($tmp_img,$dir_img);
            $imagem_doacao = $nome_img;
        }else{
            $imagem_doacao = $_POST['imagem_atual'];
        }
    };

    $id_doacao_tipo     = $_POST['id_doacao_tipo'];
    $nome_empresa       = $_POST['nome_empresa'];
    $contato_doacao     = $_POST['contato_doacao'];
    $nome_alimento      = $_POST['nome_alimento'];
    $quantidade_doacao  = $_POST['quantidade_doacao'];
    $validade_doacao    = $_POST['validade_doacao'];
    $endereco_retirada  = $_POST['endereco_retirada'];

    $query_sigla    = "SELECT sigla_tipo FROM tbtipos WHERE id_tipo = $id_doacao_tipo";
    $result_sigla   = $conn_alimentos->query($query_sigla);
    $row_sigla      = $result_sigla->fetch_assoc();
    $tipo_alimento  = $row_sigla['sigla_tipo'];

    // =============================
    // UPDATE
    // =============================
    $updateSQL  = "
        UPDATE tbdoacoes SET
            id_doacao_tipo    = '$id_doacao_tipo',
            nome_empresa      = '$nome_empresa',
            contato_doacao    = '$contato_doacao',
            tipo_alimento     = '$tipo_alimento',
            nome_alimento     = '$nome_alimento',
            quantidade_doacao = '$quantidade_doacao',
            validade_doacao   = '$validade_doacao',
            endereco_retirada = '$endereco_retirada',
            imagem_doacao     = '$imagem_doacao'
        WHERE id_doacao = '$id_doacao'
    ";

    $conn_alimentos->query($updateSQL);

    $destino = "doacao_lista.php";
    header("Location: $destino");
    exit;
};

// =============================
// BUSCAR DADOS DA DOAÇÃO
// =============================
mysqli_select_db($conn_alimentos,$database_conn);

$query_doacao = "SELECT * FROM tbdoacoes WHERE id_doacao = $id_doacao";
$result_doacao = $conn_alimentos->query($query_doacao);
$row_doacao    = $result_doacao->fetch_assoc();

// =============================
// LISTA DE TIPOS
// =============================
$tabela_fk      = "tbtipos";
$ordenar_por    = "rotulo_tipo ASC";
$consulta_fk    = "SELECT * FROM ".$tabela_fk." ORDER BY ".$ordenar_por.";";
$lista_fk       = $conn_alimentos->query($consulta_fk);
$row_fk         = $lista_fk->fetch_assoc();
$totalRows_fk   = ($lista_fk)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Doação - Área Admin</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">

    <?php include("menu_adm.php"); ?>

    <main class="container" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                
                <div class="panel panel-default panel-custom-verde">
                    
                    <div class="panel-heading panel-heading-verde text-center">
                        <h3 style="margin: 0; font-weight: bold;">
                            <i class="fa-solid fa-pen-to-square"></i> Atualizar Doação
                        </h3>
                    </div>

                    <div class="panel-body" style="padding: 30px;">
                        
                        <form action="" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="imagem_atual" value="<?php echo $row_doacao['imagem_doacao']; ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="secao-form">Dados do Doador</h4>

                                    <div class="form-group">
                                        <label for="nome_empresa">Nome da Empresa/Doador</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-building"></i></span>
                                            <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" value="<?php echo htmlspecialchars($row_doacao['nome_empresa']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="contato_doacao">Contato (WhatsApp)</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-brands fa-whatsapp"></i></span>
                                            <input type="tel" class="form-control" id="contato_doacao" name="contato_doacao" value="<?php echo htmlspecialchars($row_doacao['contato_doacao']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="endereco_retirada">Endereço para Retirada</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa-solid fa-map-location-dot"></i></span>
                                            <input type="text" class="form-control" id="endereco_retirada" name="endereco_retirada" value="<?php echo htmlspecialchars($row_doacao['endereco_retirada']); ?>" required>
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
                                                <?php do { ?>
                                                    <option value="<?php echo $row_fk['id_tipo']; ?>" <?php if($row_fk['id_tipo'] == $row_doacao['id_doacao_tipo']) echo "selected"; ?>>
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
                                            <input type="text" class="form-control" id="nome_alimento" name="nome_alimento" value="<?php echo htmlspecialchars($row_doacao['nome_alimento']); ?>" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="quantidade_doacao">Quantidade</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa-solid fa-weight-hanging"></i></span>
                                                <input type="text" class="form-control" id="quantidade_doacao" name="quantidade_doacao" value="<?php echo htmlspecialchars($row_doacao['quantidade_doacao']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="validade_doacao">Validade</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa-solid fa-calendar-days"></i></span>
                                                <input type="date" class="form-control" id="validade_doacao" name="validade_doacao" value="<?php echo htmlspecialchars($row_doacao['validade_doacao']); ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="imagem_doacao">Foto da Doação</label>
                                        <div class="well text-center" style="margin-bottom: 0; background-color: white;">
                                            
                                            <?php $foto_atual = ($row_doacao['imagem_doacao'] != '') ? $row_doacao['imagem_doacao'] : 'sem_imagem.jpg'; ?>
                                            
                                            <img src="../imagens/<?php echo $foto_atual; ?>" alt="Preview" id="imagem_preview" class="img-responsive center-block" style="max-height: 150px; margin-bottom: 10px; border-radius: 5px;">
                                            
                                            <input type="file" name="imagem_doacao" id="imagem_doacao" class="form-control" accept="image/*">
                                            <small class="text-muted">Apenas envie uma nova foto se quiser alterar a atual.</small>
                                        </div>
                                    </div> 

                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="doacao_lista.php" class="btn btn-default btn-block btn-lg" style="margin-bottom: 10px;">
                                        <i class="fa-solid fa-arrow-left"></i> Cancelar
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <button type="submit" name="enviar" class="btn btn-salvar-verde btn-block btn-lg">
                                        <i class="fa-solid fa-floppy-disk"></i> Atualizar Doação
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
    // Preview da Imagem otimizado
    document.getElementById("imagem_doacao").onchange = function(){
        var reader = new FileReader();

        if(this.files[0].size > 5242880){
            alert("A imagem deve ter no máximo 5MB."); 
            $(this).val(''); // Limpa o input se der erro
            return false;
        }

        if(this.files[0].type.indexOf("image") == -1){
            alert("Formato inválido, escolha uma imagem.");
            $(this).val('');
            return false;
        }

        reader.onload = function(e){
            document.getElementById("imagem_preview").src = e.target.result;
        };

        reader.readAsDataURL(this.files[0]);
    };
    </script>
</body>
</html>