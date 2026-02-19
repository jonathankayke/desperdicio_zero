<?php
// Incluindo o Sistema de autenticação
include("acesso_user.php");

// Incluir o arquivo e fazer a conexão
include("../Connections/conn_alimentos.php");

// Variáveis Globais
$tabela         =   "tbtipos";
$campo_filtro   =   "id_tipo";


if($_POST){
    // Selecionar o banco de dados (USE)
    mysqli_select_db($conn_alimentos,$database_conn);

    // Receber os dados do formulário
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
    <title>Atualizar Tipo - Área Admin</title>
    <script src="https://kit.fontawesome.com/9ee3096070.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>

<body class="fundofixo">

<?php include("menu_adm.php"); ?>

<main class="container" style="margin-top: 50px;">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3"> 
            
            <div class="panel panel-default panel-custom-laranja">
                
                <div class="panel-heading panel-heading-laranja text-center">
                    <h3 style="margin: 0; font-weight: bold;">
                        <i class="fa-solid fa-layer-group"></i> Atualizar Tipo
                    </h3>
                </div>

                <div class="panel-body" style="padding: 30px;">
                    <form action="tipos_atualiza.php" enctype="multipart/form-data" method="post" id="form_atualiza_tipo" name="form_atualiza_tipo">
                        
                        <input type="hidden" name="id_tipo" id="id_tipo" value="<?php echo $row['id_tipo']; ?>">

                        <div class="form-group">
                            <label for="rotulo_tipo">Rótulo (Nome do Tipo)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa-solid fa-tag"></i></span>
                                <input type="text" name="rotulo_tipo" id="rotulo_tipo" class="form-control" autofocus maxlength="15" required placeholder="Ex: Legumes, Frutas..." value="<?php echo htmlspecialchars($row['rotulo_tipo']); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sigla_tipo">Sigla (Abreviação)</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa-solid fa-font"></i></span>
                                <input type="text" name="sigla_tipo" id="sigla_tipo" class="form-control" maxlength="3" required placeholder="Ex: LEG, FRU..." style="text-transform: uppercase;" value="<?php echo htmlspecialchars($row['sigla_tipo']); ?>">
                            </div>
                            <small class="text-muted">Máximo de 3 caracteres.</small>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-6">
                                <a href="tipos_lista.php" class="btn btn-default btn-block btn-lg">
                                    <i class="fa-solid fa-arrow-left"></i> Cancelar
                                </a>
                            </div>
                            <div class="col-xs-6">
                                <button type="submit" name="enviar" class="btn btn-salvar-laranja btn-block btn-lg">
                                    <i class="fa-solid fa-floppy-disk"></i> Atualizar
                                </button>
                            </div>
                        </div>

                    </form>
                </div> </div> </div> 
    </div> 
</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
<?php mysqli_free_result($lista); ?>