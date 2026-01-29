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
