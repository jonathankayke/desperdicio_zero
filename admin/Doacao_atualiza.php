<?php
// Incluir o arquivo e fazer a conexão
Include('../Connections/conn_alimentos.php'); 

// Variáveis Globais
$tabela         =   "tbdoacoes";
$campo_filtro   =   "id_doacao";

if($_POST){     // ATUALIZANDO NO BANCO DE DADOS
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos,$database_conn);

    // Guardar o nome da imagem no banco e o arquivo no diretório
    if($_FILES['imagem_doacao']['name']){
        $nome_img   =   $_FILES['imagem_doacao']['name'];
        $tmp_img    =   $_FILES['imagem_doacao']['tmp_name'];
        $dir_img    =   "../imagens/".$nome_img;
        move_uploaded_file($tmp_img,$dir_img);
    }else{
        $nome_img=$_POST['imagem_doacao_atual'];
    };

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_doacao_tipo    =   $_POST['id_doacao_tipo'];
    $nome_empresa   =   $_POST['nome_empresa'];
    $tipo_instituicao     =   $_POST['tipo_instituicao'];
    $contato_doacao     =   $_POST['contato_doacao'];     
    $tipo_alimento      =   $_POST['tipo_alimento'];
    $nome_alimento      =   $_POST['nome_alimento'];
    $quantidade_doacao  =   $_POST['quantidade_doacao'];
    $validade_doacao    =   $_POST['validade_doacao'];
    $endereco_retirada  =   $_POST['endereco_retirada'];
    $imagem_doacao     =   $nome_img;

    // Campo para filtrar o registro (WHERE)
    $filtro_update      =   $_POST['id_doacao'];

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET id_doacao_tipo      =    '".$id_doacao_tipo."'  ,
                            nome_empresa        =      '".$nome_empresa."' ,    
                            tipo_instituicao    =   '".$tipo_instituicao."'   ,
                            contato_doacao      =   '".$contato_doacao."'   ,
                            tipo_alimento       =   '".$tipo_alimento."'    ,
                            nome_alimento       =   '".$nome_alimento."'    ,
                            quantidade_doacao   =   '".$quantidade_doacao."'    ,
                            validade_doacao     =   '".$validade_doacao."'    ,
                            endereco_retirada   =   '".$endereco_retirada."'    ,
                            imagem_doacao       =   '".$imagem_doacao."'   
                    WHERE ".$campo_filtro."     =   '".$filtro_update."';
                    ";
    $resultado  =   $conn_alimentos->query($updateSQL);

    // Após a ação a página será redirecionada
    $destino    =   "produtos_lista.php";
    if(mysqli_insert_id($conn_alimentos)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

// Consulta para trazer e filtrar os dados
// Definir o USE do banco de dados;
mysqli_select_db($conn_alimentos,$database_conn);
$filtro_select    =   $_GET['id_doacao'];
$consulta           =   "
                    SELECT *
                    FROM    ".$tabela."
                    WHERE ".$campo_filtro."=".$filtro_select.";
                    ";
$lista          =   $conn_produtos->query($consulta);
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;

// Selecionar o banco de dados (USE)
mysqli_select_db($conn_alimentos,$database_conn);

// Selecionar os dados da chave estrangeira
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
    <title>Atualizar Doação</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<?php include("menu_adm.php"); ?>

<body class="fundofixo">

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1">

                <h1 class="text-center"
                    style="color:white; text-shadow:1px 1px 3px rgba(0,0,0,0.5); margin-bottom:20px;">
                    Atualização de Doação
                </h1>

                <div class="thumbnail" style="border:none; background:none; box-shadow:none;">

                    <div class="alert alert-success" role="alert">

                        <form action="processa_atualiza_doacao.php"
                              method="POST" enctype="multipart/form-data">

                            <!-- ID DA DOAÇÃO -->
                            <input type="hidden" name="id_doacao" value="<?=$dados['id_doacao']?>">

                            <div class="row">
                                <div class="col-md-6">

                                    <h3 class="secao-titulo">Dados do Doador</h3>

                                    <div class="form-group">
                                        <label for="nome_doador">Seu Nome/Nome da Empresa</label>
                                        <input type="text" class="form-control" id="nome_doador"
                                               name="nome_doador" required
                                               value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo_instituicao">Tipo de Instituição</label>
                                        <input type="text" class="form-control" id="tipo_instituicao"
                                               name="tipo_instituicao" required
                                               value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="whatsapp">Contato (WhatsApp)</label>
                                        <input type="tel" class="form-control" id="whatsapp" 
                                               name="whatsapp" required
                                               value="">
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <h3 class="secao-titulo">Dados da Doação</h3>

                                    <div class="form-group">
                                        <label for="tipo_alimento">Tipo de Alimento</label>
                                        <select class="form-select form-control" id="tipo_alimento"
                                                name="tipo_alimento" required>
                                            <option value="" disabled>Selecione uma categoria</option>

                                            <!-- Exemplo de categorias -->
                                            <option value="Frutas">Frutas</option>
                                            <option value="Verduras" >Verduras</option>
                                            <option value="Pães" >Pães</option>
                                            <option value="Cereais" >Cereais</option>

                                            <!-- Você pode carregar dinamicamente do BD -->
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="alimento_especifico">Alimento Específico</label>
                                        <input type="text" class="form-control" id="alimento_especifico"
                                               name="alimento_especifico" required
                                               value="">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="quantidade">Quantidade</label>
                                            <input type="text" class="form-control" id="quantidade"
                                                   name="quantidade" required
                                                   value="">
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label for="validade">Validade</label>
                                            <input type="date" class="form-control" id="validade"
                                                   name="validade" required
                                                   value="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="endereco">Endereço para Retirada</label>
                                        <input type="text" class="form-control" id="endereco"
                                               name="endereco" required
                                               value="">
                                    </div>

                                    <div class="form-group">
                                        <label>Imagem Atual</label><br>

                                        <img src="../imagens/doacoes/"
                                             class="img-responsive"
                                             style="max-height:250px; border:2px solid #ccc;">

                                        <br><br>

                                        <label for="imagem_produto">Nova Imagem (opcional)</label>

                                        <input type="file" name="imagem_produto" id="imagem_produto"
                                               class="form-control" accept="image/*">

                                        <img id="imagem" src="" alt=""
                                             class="img-responsive"
                                             style="max-height:250px; margin-top:10px; display:none;">
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                                        Atualizar Doação
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("../rodape.php"); ?>

    <!-- Preview da imagem -->
    <script>
        document.getElementById("imagem_produto").onchange = function () {
            var reader = new FileReader();

            if (this.files[0].size > 512000) {
                alert("A imagem deve ter no máximo 500kb.");
                $("#imagem").hide().attr("src", "");
                this.value = "";
                return false;
            }

            if (this.files[0].type.indexOf("image") === -1) {
                alert("Formato inválido, selecione uma imagem.");
                $("#imagem").hide().attr("src", "");
                this.value = "";
                return false;
            }

            reader.onload = function (e) {
                document.getElementById("imagem").src = e.target.result;
                $("#imagem").show();
            };

            reader.readAsDataURL(this.files[0]);
        };
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

</body>
</html>
