<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos, $database_conn);

    $tabela_insert  =   "tbdoacoes";
    $campos_insert  =   "
                            id_doacao_tipo,
                            nome_empresa,
                            contato_doacao,
                            tipo_alimento,
                            nome_alimento,
                            quantidade_doacao,
                            validade_doacao,
                            endereco_retirada,
                            imagem_doacao
                        ";

    
    if(isset($_POST['enviar'])){
        $nome_img   =   $_FILES['imagem_doacao']['name'];
        $tmp_img    =   $_FILES['imagem_doacao']['tmp_name'];
        $dir_img    =   "../imagens/".$nome_img;
        move_uploaded_file($tmp_img,$dir_img);
    };


    $id_doacao_tipo     =   $_POST['id_doacao_tipo'];
    $nome_empresa       =   $_POST['nome_empresa'];

    $contato_doacao     =   $_POST['contato_doacao'];
    $nome_alimento      =   $_POST['nome_alimento'];
    $quantidade_doacao  =   $_POST['quantidade_doacao'];
    $validade_doacao    =   $_POST['validade_doacao'];
    $endereco_retirada  =   $_POST['endereco_retirada'];
    $imagem_doacao      =   $_FILES['imagem_doacao']['name'];

   
    $query_sigla    = "SELECT sigla_tipo FROM tbtipos WHERE id_tipo = $id_doacao_tipo";
    $result_sigla   = $conn_alimentos->query($query_sigla);
    $row_sigla      = $result_sigla->fetch_assoc();
    $tipo_alimento  = $row_sigla['sigla_tipo'];

 
    $valores_insert =   "
                            '$id_doacao_tipo',
                            '$nome_empresa',
                            '$tipo_instituicao',
                            '$contato_doacao',
                            '$tipo_alimento',
                            '$nome_alimento',
                            '$quantidade_doacao',
                            '$validade_doacao',
                            '$endereco_retirada',
                            '$imagem_doacao'
                        ";

    // Consulta SQL para inserção dos dados
    $insertSQL  =   "
                    INSERT INTO ".$tabela_insert."
                        (".$campos_insert.")
                    VALUES
                        (".$valores_insert.");
                    ";
    $resultado  =   $conn_alimentos->query($insertSQL);

 
    $destino    =   "doacao_lista.php";
    if(mysqli_insert_id($conn_alimentos)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

// Selecionar o banco de dados (USE)
mysqli_select_db($conn_alimentos,$database_conn);


$tabela_fk      =   "tbtipos";
$ordenar_por    =   "rotulo_tipo ASC";
$consulta_fk    =   "
                    SELECT *
                    FROM    ".$tabela_fk."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista_fk       =   $conn_alimentos->query($consulta_fk);
$row_fk         =   $lista_fk->fetch_assoc();
$totalRows_fk   =   ($lista_fk)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Doações</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<?php include("menu_adm.php") ?>

<body class="fundofixo">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">
                <h1 class="text-center" style="color: white; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); margin-bottom: 20px;">
                    Cadastro de Doação
                </h1>

                <div class="thumbnail" style="border: none; background: none; box-shadow: none;">
                    <div class="alert alert-success" role="alert">
                        <form action="" method="POST" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados do Doador</h3>

                                    <div class="form-group">
                                        <label for="nome_empresa" class="form-label">Nome da Empresa/Doador</label>
                                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" placeholder="Ex: Restaurante Sabor" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="contato_doacao" class="form-label">Contato (WhatsApp)</label>
                                        <input type="tel" class="form-control" id="contato_doacao" name="contato_doacao" placeholder="(XX) 9XXXX-XXXX" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="endereco_retirada" class="form-label">Endereço para Retirada</label>
                                        <input type="text" class="form-control" id="endereco_retirada" name="endereco_retirada" placeholder="Rua, Número, Bairro" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados da Doação</h3>

                                    <div class="form-group">
                                        <label for="id_doacao_tipo" class="form-label">Categoria do Alimento</label>
                                        <select class="form-select form-control" id="id_doacao_tipo" name="id_doacao_tipo" required>
                                            <option value="" selected disabled>Selecione uma categoria</option>
                                            <?php do { ?>
                                                <option value="<?php echo $row_fk['id_tipo']; ?>">
                                                    <?php echo $row_fk['rotulo_tipo']; ?>
                                                </option>
                                            <?php } while ($row_fk = $lista_fk->fetch_assoc()); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="nome_alimento" class="form-label">Nome do Alimento</label>
                                        <input type="text" class="form-control" id="nome_alimento" name="nome_alimento" placeholder="Ex: Maçã Fuji, Pão Francês" required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="quantidade_doacao" class="form-label">Quantidade</label>
                                            <input type="text" class="form-control" id="quantidade_doacao" name="quantidade_doacao" placeholder="Ex: 5 kg" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="validade_doacao" class="form-label">Validade</label>
                                            <input type="date" class="form-control" id="validade_doacao" name="validade_doacao" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="imagem_doacao">Foto da Doação</label>
                                        <input type="file" name="imagem_doacao" id="imagem_doacao" class="form-control" accept="image/*">
                                        
                                        <img src="" alt="" id="imagem_preview" class="img-responsive" style="max-height: 200px; display:none; margin-top: 10px;">
                                    </div> 
                                </div>
                            </div>

                            <input type="submit" value="Salvar Doação" name="enviar" class="btn btn-success btn-block" style="margin-top: 20px;">
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
        
       
        $("#imagem").attr("src","blank");
        $("#imagem").hide();
        $("#imagem_doacao").wrap('<form>').closest('form').get(0).reset();
        $("#imagem_doacao").unwrap();
        return false;
    }
    
    if(this.files[0].type.indexOf("image") == -1){
        alert("Formato inválido, escolha uma imagem.");
        $("#imagem").attr("src","blank");
        $("#imagem").hide();
        $("#imagem_doacao").wrap('<form>').closest('form').get(0).reset();
        $("#imagem_doacao").unwrap();
        return false;
    }
    
    reader.onload = function(e){
       
        document.getElementById("imagem").src = e.target.result;
        $("#imagem").show(); 
    };
   
    reader.readAsDataURL(this.files[0]);
};
</script>
</body>
</html>