<?php
// Incluindo o Sistema de autenticação
include("acesso_User.php");
?>
<!DOCTYPE html>
<html lang="pt.br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área Administrativa</title>
</head>
<body>
    <?php include('menu_adm.php'); ?>
    <?php include('adm_options.php'); ?>
</body>
</html>