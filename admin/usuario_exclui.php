<?php
// Incluindo o Sistema de autenticação
include("acesso_admin.php");

Include('../Connections/conn_alimentos.php'); 

mysqli_select_db($conn_alimentos,$database_conn);

$tabela_delete  =   "tbusuarios";
$id_tabela_del  =   "id_usuario";
$id_filtro_del  =   $_GET['id_usuario'];

$deleteSQL  =   "
                DELETE  
                FROM    ".$tabela_delete."
                WHERE   ".$id_tabela_del."=".$id_filtro_del.";
                ";
$resultado  =   $conn_alimentos->query($deleteSQL);

$destino    =   "usuario_lista.php";
if(mysqli_insert_id($conn_alimentos)){
    header("Location: $destino");
}else{
    header("Location: $destino");
}
?>