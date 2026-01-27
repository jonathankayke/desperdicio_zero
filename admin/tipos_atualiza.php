<?php
// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

// Variáveis Globais
$tabela         =   "tbtipos";
$campo_filtro   =   "id_tipo";


if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos,$database_conn);

    // Receber os dados do formulário
    // Organizar os campos na mesma ordem
    $rotulo_tipo    =   $_POST['rotulo_tipo'];
    $sigla_tipo     =   $_POST['sigla_tipo'];

    // Campo para filtrar o registro (WHERE)
    $filtro_update  =   $_POST['id_tipo'];

    // Consulta SQL para ATUALIZAÇÃO dos dados
    $updateSQL  =   "
                    UPDATE ".$tabela."
                        SET sigla_tipo  =   '".$sigla_tipo."'   ,
                            rotulo_tipo =   '".$rotulo_tipo."'
                    WHERE ".$campo_filtro."='".$filtro_update."';
                    ";
    $resultado  =   $conn_alimentos->query($updateSQL);

    // Após a ação a página será redirecionada
    $destino    =   "tipos_lista.php";
    if(mysqli_insert_id($conn_alimentos)){
        header("Location: $destino");
    }else{
        header("Location: $destino");
    };
};

// Consulta para trazer e filtrar os dados
// Definir o USE do banco de dados
mysqli_select_db($conn_alimentos,$database_conn);
$filtro_select  =   $_GET['id_tipo'];
$consulta       =   "
                    SELECT *
                    FROM    ".$tabela."
                    WHERE   ".$campo_filtro."=".$filtro_select.";
                    ";
$lista          =   $conn_alimentos->query($consulta);
$row            =   $lista->fetch_assoc();
$totalRows      =   ($lista)->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos - Atualiza</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
<?php include("menu_adm.php"); ?>
<main class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-3 col-sm-6 col-md-offset-4 col-md-4" > <!-- abre dimensionamento -->
            <h2 class="breadcrumb text-success
            ">
                <a href="tipos_lista.php">
                    <button class="btn btn-success
                    ">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>
                </a>
                Atualiza Tipo
            </h2>
            <div class="thumbnail">
                <div class="alert alert-success
                ">
                    <form 
                        action="tipos_atualiza.php"
                        enctype="multipart/form-data"
                        method="post"
                        id="form_atualiza_tipo"
                        name="form_atualiza_tipo"
                    >
                        <!-- Inserir campo id_tipo OCULTO para uso em filtro -->
                        <input 
                            type="hidden"
                            name="id_tipo"
                            id="id_tipo"
                            value="<?php echo $row['id_tipo']; ?>"
                        >

                        <!-- text rotulo_tipo -->
                        <label for="rotulo_tipo">Rótulo:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-apple"></span>
                            </span>
                            <input 
                                type="text" 
                                name="rotulo_tipo" 
                                id="rotulo_tipo"
                                class="form-control"
                                autofocus
                                maxlength="15"
                                required
                                placeholder="Digite o rótulo do tipo."
                                value="<?php echo $row['rotulo_tipo']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text rotulo_tipo -->
                        <br>

                        <!-- text sigla_tipo -->
                        <label for="sigla_tipo">Sigla:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-th-list"></span>
                            </span>
                            <input 
                                type="text" 
                                name="sigla_tipo" 
                                id="sigla_tipo"
                                class="form-control"
                                maxlength="3"
                                required
                                placeholder="Digite a sigla do tipo."
                                value="<?php echo $row['sigla_tipo']; ?>"
                            >
                        </div> <!-- fecha input-group -->
                        <!-- fecha text sigla_tipo -->
                        <br>

                        <!-- btn enviar -->
                        <input 
                            type="submit" 
                            value="Atualizar"
                            name="enviar"
                            id="enviar"
                            role="button"
                            class="btn btn-success
                             btn-block"
                        >
                    </form>
                </div> <!-- fecha alert alert-warning  -->
            </div> <!-- thumbnail -->
        </div> <!-- dimensionamento -->
    </div> <!-- fecha row -->
</main>



<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
<?php mysqli_free_result($lista); ?>