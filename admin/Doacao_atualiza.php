<?php
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
    $tipo_alimento      = $_POST['tipo_alimento'];
    $nome_alimento      = $_POST['nome_alimento'];
    $quantidade_doacao  = $_POST['quantidade_doacao'];
    $validade_doacao    = $_POST['validade_doacao'];
    $endereco_retirada  = $_POST['endereco_retirada'];

    $query_sigla    = "SELECT sigla_tipo FROM tbtipos WHERE id_tipo = $id_doacao_tipo";
    $result_sigla   = $conn_alimentos->query($query_sigla);
    $row_sigla      = $result_sigla->fetch_assoc();
    $tipo_alimento  = $row_sigla['sigla_tipo'];

    // =============================
    // UPDATE (no lugar do INSERT)
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

$query_doacao = "
    SELECT *
    FROM tbdoacoes
    WHERE id_doacao = $id_doacao
";
$result_doacao = $conn_alimentos->query($query_doacao);
$row_doacao    = $result_doacao->fetch_assoc();

// =============================
// LISTA DE TIPOS
// =============================
$tabela_fk      = "tbtipos";
$ordenar_por    = "rotulo_tipo ASC";
$consulta_fk    = "
                    SELECT *
                    FROM    ".$tabela_fk."
                    ORDER BY ".$ordenar_por."; 
                    ";
$lista_fk       = $conn_alimentos->query($consulta_fk);
$row_fk         = $lista_fk->fetch_assoc();
$totalRows_fk   = ($lista_fk)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Doações</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<?php include("menu_adm.php") ?>

<body class="fundofixo">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h1 class="text-center" style="color: white; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); margin-bottom: 20px;">
                    Atualizar Doação
                </h1>

                <div class="thumbnail" style="border: none; background: none; box-shadow: none;">
                    <div class="alert alert-success" role="alert">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="imagem_atual" value="<?php echo $row_doacao['imagem_doacao']; ?>">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados do Doador</h3>

                                    <div class="form-group">
                                        <label for="nome_empresa" class="form-label">Nome da Empresa/Doador</label>
                                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa"
                                        value="<?php echo $row_doacao['nome_empresa']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="contato_doacao" class="form-label">Contato (WhatsApp)</label>
                                        <input type="tel" class="form-control" id="contato_doacao" name="contato_doacao"
                                        value="<?php echo $row_doacao['contato_doacao']; ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="endereco_retirada" class="form-label">Endereço para Retirada</label>
                                        <input type="text" class="form-control" id="endereco_retirada" name="endereco_retirada"
                                        value="<?php echo $row_doacao['endereco_retirada']; ?>" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados da Doação</h3>

                                    <div class="form-group">
                                        <label for="id_doacao_tipo" class="form-label">Categoria do Alimento</label>
                                        <select class="form-select form-control" id="id_doacao_tipo" name="id_doacao_tipo" required>
                                            <?php do { ?>
                                                <option value="<?php echo $row_fk['id_tipo']; ?>"
                                                <?php if($row_fk['id_tipo']==$row_doacao['id_doacao_tipo']) echo "selected"; ?>>
                                                    <?php echo $row_fk['rotulo_tipo']; ?>
                                                </option>
                                            <?php } while ($row_fk = $lista_fk->fetch_assoc()); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="nome_alimento" class="form-label">Nome do Alimento</label>
                                        <input type="text" class="form-control" id="nome_alimento" name="nome_alimento"
                                        value="<?php echo $row_doacao['nome_alimento']; ?>" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="quantidade_doacao" class="form-label">Quantidade</label>
                                            <input type="text" class="form-control" id="quantidade_doacao" name="quantidade_doacao"
                                            value="<?php echo $row_doacao['quantidade_doacao']; ?>" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="validade_doacao" class="form-label">Validade</label>
                                            <input type="date" class="form-control" id="validade_doacao" name="validade_doacao"
                                            value="<?php echo $row_doacao['validade_doacao']; ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="imagem_doacao">Foto da Doação</label>
                                        <input type="file" name="imagem_doacao" id="imagem_doacao" class="form-control" accept="image/*">

                                        <img src="../imagens/<?php echo $row_doacao['imagem_doacao']; ?>"
                                        alt="" id="imagem_preview"
                                        class="img-responsive"
                                        style="max-height: 200px; margin-top:10px;">
                                    </div> 
                                </div>
                            </div>

                            <input type="submit" value="Atualizar Doação" name="enviar" class="btn btn-success btn-block" style="margin-top: 20px;">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
document.getElementById("imagem_doacao").onchange = function(){
    var reader = new FileReader();

    if(this.files[0].size > 5242880){
        alert("A imagem deve ter no máximo 5MB."); 
        $("#imagem_preview").hide();
        $("#imagem_doacao").wrap('<form>').closest('form').get(0).reset();
        $("#imagem_doacao").unwrap();
        return false;
    }

    if(this.files[0].type.indexOf("image") == -1){
        alert("Formato inválido, escolha uma imagem.");
        $("#imagem_preview").hide();
        $("#imagem_doacao").wrap('<form>').closest('form').get(0).reset();
        $("#imagem_doacao").unwrap();
        return false;
    }

    reader.onload = function(e){
        document.getElementById("imagem_preview").src = e.target.result;
        $("#imagem_preview").show(); 
    };

    reader.readAsDataURL(this.files[0]);
};
</script>
</body>
</html>
