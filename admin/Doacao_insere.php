<?php 
include("../Connections/conn_alimentos.php");

if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos,$database_conn);

    // Variáveis para acrescentar dados no banco
    $tabela_insert  =   "tbdoacoes";
    $campos_insert  =   "
                            id_doacao_tipo,
                            nome_empresa,
                            tipo_instituicao,
                            contato_doacao,
                            tipo_alimento,
                            imagem_produto,
                            nome_alimento,
                            quantidade_doacao,
                            validade_doacao,
                            endereco_retirada,
                            imagem_doacao
                        ";

    // Guardar o nome da imagem no banco e o arquivo no diretório
    if(isset($_POST['enviar'])){
        $nome_img   =   $_FILES['imagem_produto']['name'];
        $tmp_img    =   $_FILES['imagem_produto']['tmp_name'];
        $dir_img    =   "../imagens/".$nome_img;
        move_uploaded_file($tmp_img,$dir_img);
    };

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $id_tipo_produto    =   $_POST['id_tipo_produto'];
    $destaque_produto   =   $_POST['destaque_produto'];
    $descri_produto     =   $_POST['descri_produto'];
    $resumo_produto     =   $_POST['resumo_produto'];     
    $valor_produto      =   $_POST['valor_produto'];
    $imagem_produto     =   $_FILES['imagem_produto']['name'];

    // Reunir os valores a serem inseridos
    $valores_insert =   "
                        '$id_tipo_produto',
                        '$destaque_produto',
                        '$descri_produto',
                        '$resumo_produto',
                        '$valor_produto',
                        '$imagem_produto'
                        ";

    // Consulta SQL para inserção dos dados
    $insertSQL  =   "
                    INSERT INTO ".$tabela_insert."
                        (".$campos_insert.")
                    VALUES
                        (".$valores_insert.");
                    ";
    $resultado  =   $conn_produtos->query($insertSQL);

    // Após a ação a página será redirecionada
    $destino    =   "produtos_lista.php";
    if(mysqli_insert_id($conn_produtos)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

// Selecionar o banco de dados (USE)
mysqli_select_db($conn_produtos,$database_conn);

// Selecionar os dados da chave estrangeira
$tabela_fk      =   "tbtipos";
$ordenar_por    =   "rotulo_tipo ASC";
$consulta_fk    =   "
                    SELECT *
                    FROM    ".$tabela_fk."
                    ORDER BY ".$ordenar_por.";
                    ";
$lista_fk       =   $conn_produtos->query($consulta_fk);
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

                <h1 class="text-center"
                    style="color: white; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); margin-bottom: 20px;">
                    Cadastro
                </h1>

                <div class="thumbnail" style="border: none; background: none; box-shadow: none;">

                    <div class="alert alert-success" role="alert">
                        <form action="processar_cadastro.php" method="POST">

                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados do Doador</h3>

                                    <div class="form-group">
                                        <label for="nome_doador" class="form-label">Seu Nome/Nome da Empresa</label>
                                        <input type="text" class="form-control" id="nome_doador" name="nome_doador"
                                            placeholder="Ex: Restaurante Sabor da Casa" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="tipo_instituicao" class="form-label">Tipo de Instituição</label>
                                        <input type="text" class="form-control" id="tipo_instituicao"
                                            name="tipo_instituicao" placeholder="Ex: Mercado, Restaurante, Igreja, etc."
                                            required>
                                    </div>

                                    

                                    <div class="form-group">
                                        <label for="whatsapp" class="form-label">Contato (WhatsApp)</label>
                                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                            placeholder="(XX) 9XXXX-XXXX" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h3 class="secao-titulo">Dados da Doação</h3>

                                    <div class="form-group">
                                        <label for="tipo_alimento" class="form-label">Tipo de Alimento</label>
                                        <select class="form-select form-control" id="tipo_alimento" name="tipo_alimento"
                                            required>
                                            <option value="" selected disabled>Selecione uma categoria</option>
                                            <option value="#"><!-- coloque o php para mostrar as opçao --></option>
                                          
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="alimento_especifico" class="form-label">Alimento Específico</label>
                                        <input type="text" class="form-control" id="alimento_especifico"
                                            name="alimento_especifico" placeholder="Ex: Maçã, Arroz, Pão Francês"
                                            required>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="quantidade" class="form-label">Quantidade</label>
                                            <input type="text" class="form-control" id="quantidade" name="quantidade"
                                                placeholder="Ex: 5 kg" required>
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="validade" class="form-label">Validade</label>
                                            <input type="date" class="form-control" id="validade" name="validade"
                                                required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="endereco" class="form-label">Endereço para Retirada</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco"
                                            placeholder="Rua, Número, Bairro, Cidade" required>
                                    </div>

                                    <div class=" form-group">
                                    <label for="imagem_produto">Imagem</label>
                                    
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-picture"></span>
                                        </span>
                                        <!-- Exibir a imagem a ser inserida -->
                                        <img 
                                            src="" 
                                            alt=""
                                            name="imagem"
                                            id="imagem"
                                            class="img-responsive"
                                            style="max-height: 500px;"
                                        >
                                        <input 
                                            type="file" 
                                            name="imagem_produto" 
                                            id="imagem_produto"
                                            class="form-control"
                                            accept="image/*"
                                        >
                                    </div> 
                                   
                                </div>
                            </div>

                            <input 
                            type="submit" 
                            value="Salvar Doação"
                            name="enviar"
                            id="enviar"
                            class="btn btn-danger btn-block"
                         >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Script para a imagem -->
    <script>
        document.getElementById("imagem_produto").onchange = function(){
            var reader = new FileReader();
            if(this.files[0].size>512000){
                alert("A imagem deve ter no máximo 500kb.");
                $("#imagem").attr("src","blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;
            }
            if(this.files[0].type.indexOf("image")==-1){
                alert("Formato inválido, escolha uma imagem.");
                $("#imagem").attr("src","blank");
                $("#imagem").hide();
                $("#imagem_produto").wrap('<form>').closest('form').get(0).reset();
                $("#imagem_produto").unwrap();
                return false;
            }
            reader.onload = function(e){
                // obter dados carregados e renderizar uma miniatura.
                document.getElementById("imagem").src = e.target.result;
                $("imagem").show();
            };
        // leia o arquivo de imagem como um URL de dados.
        reader.readAsDataURL(this.files[0]);
        };
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>