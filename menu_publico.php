<?php
// Incluir o arquivo para fazer a conexão
include("Connections/conn_alimentos.php");
 
// Consulta para trazer os dados
$tabela_menu    =   "tbtipos";
$ordernar_menu  =   "rotulo_tipo";
$consulta_menu  =   "
                    SELECT  *
                    FROM    ".$tabela_menu."
                    ORDER BY ".$ordernar_menu.";
                    ";
$lista_menu     =   $conn_alimentos->query($consulta_menu);
$row_menu       =   $lista_menu->fetch_assoc();
$totalRows_menu =   ($lista_menu)->num_rows;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Pública</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="css/meu_estilo.css">
</head>
<body>
    <? include('admin/menu_admin.php'); ?>
</body>