<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

// ===============================
// VALIDAR ID
// ===============================
if(!isset($_GET['id_doacao'])){
    header("Location: doacao_lista.php");
    exit;
}

$id_doacao = (int) $_GET['id_doacao'];

// ===============================
// BUSCAR DADOS DA DOAÇÃO
// ===============================
$sql_busca = "SELECT * FROM tbdoacoes WHERE id_doacao = $id_doacao";
$resultado_busca = $conn_alimentos->query($sql_busca);
$dados = $resultado_busca->fetch_assoc();

if(!$dados){
    header("Location: doacao_lista.php");
    exit;
}

// ===============================
// ATUALIZAR
// ===============================
if(isset($_POST['enviar'])){

    $id_doacao_tipo     = (int) $_POST['id_doacao_tipo'];
    $nome_empresa       = $_POST['nome_empresa'];
    $contato_doacao     = $_POST['contato_doacao'];
    $nome_alimento      = $_POST['nome_alimento'];
    $quantidade_doacao  = $_POST['quantidade_doacao'];
    $validade_doacao    = $_POST['validade_doacao'];
    $endereco_retirada  = $_POST['endereco_retirada'];

    // ===============================
    // TIPO DE ALIMENTO (SIGLA)
    // ===============================
    $query_sigla   = "SELECT sigla_tipo FROM tbtipos WHERE id_tipo = $id_doacao_tipo";
    $result_sigla  = $conn_alimentos->query($query_sigla);
    $row_sigla     = $result_sigla->fetch_assoc();
    $tipo_alimento = $row_sigla['sigla_tipo'];

    // ===============================
    // IMAGEM
    // ===============================
    if(!empty($_FILES['imagem_doacao']['name'])){

        $imagem_doacao = $_FILES['imagem_doacao']['name'];
        $tmp_img       = $_FILES['imagem_doacao']['tmp_name'];

        move_uploaded_file($tmp_img, "../imagens/".$imagem_doacao);

    }else{
        $imagem_doacao = $dados['imagem_doacao'];
    }

    // ===============================
    // SQL UPDATE
    // ===============================
    $updateSQL = "
        UPDATE tbdoacoes SET
            id_doacao_tipo     = '$id_doacao_tipo',
            nome_empresa       = '$nome_empresa',
            contato_doacao     = '$contato_doacao',
            tipo_alimento      = '$tipo_alimento',
            nome_alimento      = '$nome_alimento',
            quantidade_doacao  = '$quantidade_doacao',
            validade_doacao    = '$validade_doacao',
            endereco_retirada  = '$endereco_retirada',
            imagem_doacao      = '$imagem_doacao'
        WHERE id_doacao = $id_doacao
    ";

    $conn_alimentos->query($updateSQL);
    header("Location: doacao_lista.php");
}

// ===============================
// LISTAR TIPOS
// ===============================
$consulta_fk = "SELECT * FROM tbtipos ORDER BY rotulo_tipo ASC";
$lista_fk    = $conn_alimentos->query($consulta_fk);
$row_fk      = $lista_fk->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Atualizar Doação</title>
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<?php include("menu_adm.php") ?>

<body class="fundofixo">

<div class="container">
<div class="row">
<div class="col-xs-12 col-md-10 col-md-offset-1">

<h1 class="text-center" style="color:white; margin-bottom:20px;">
Atualizar Doação
</h1>

<div class="thumbnail" style="border:none; background:none;">
<div class="alert alert-success">

<form method="POST" enctype="multipart/form-data">

<div class="row">
<div class="col-md-6">
<h3 class="secao-titulo">Dados do Doador</h3>

<div class="form-group">
<label>Nome da Empresa/Doador</label>
<input type="text" class="form-control" name="nome_empresa"
value="<?= $dados['nome_empresa']; ?>" required>
</div>

<div class="form-group">
<label>Contato (WhatsApp)</label>
<input type="tel" class="form-control" name="contato_doacao"
value="<?= $dados['contato_doacao']; ?>" required>
</div>

<div class="form-group">
<label>Endereço para Retirada</label>
<input type="text" class="form-control" name="endereco_retirada"
value="<?= $dados['endereco_retirada']; ?>" required>
</div>
</div>

<div class="col-md-6">
<h3 class="secao-titulo">Dados da Doação</h3>

<div class="form-group">
<label>Categoria do Alimento</label>
<select name="id_doacao_tipo" class="form-control" required>
<?php do { ?>
<option value="<?= $row_fk['id_tipo']; ?>"
<?= ($row_fk['id_tipo']==$dados['id_doacao_tipo'])?'selected':''; ?>>
<?= $row_fk['rotulo_tipo']; ?>
</option>
<?php } while($row_fk = $lista_fk->fetch_assoc()); ?>
</select>
</div>

<div class="form-group">
<label>Nome do Alimento</label>
<input type="text" class="form-control" name="nome_alimento"
value="<?= $dados['nome_alimento']; ?>" required>
</div>

<div class="row">
<div class="col-md-6 form-group">
<label>Quantidade</label>
<input type="text" class="form-control" name="quantidade_doacao"
value="<?= $dados['quantidade_doacao']; ?>" required>
</div>

<div class="col-md-6 form-group">
<label>Validade</label>
<input type="date" class="form-control" name="validade_doacao"
value="<?= $dados['validade_doacao']; ?>" required>
</div>
</div>

<div class="form-group">
<label>Imagem da Doação</label>
<input type="file" name="imagem_doacao" id="imagem_doacao" class="form-control">

<img id="previewImagem"
     src="../imagens/<?= $dados['imagem_doacao']; ?>"
     class="img-responsive"
     style="max-height:200px; margin-top:10px; border:1px solid #ccc;">
</div>

</div>
</div>

<input type="submit" name="enviar"
value="Atualizar Doação"
class="btn btn-success btn-block">

</form>

</div>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<!-- PREVIEW DA IMAGEM -->
<script>
document.getElementById('imagem_doacao').addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){
        const reader = new FileReader();
        reader.onload = function(event){
            document.getElementById('previewImagem').src = event.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

</body>
</html>
