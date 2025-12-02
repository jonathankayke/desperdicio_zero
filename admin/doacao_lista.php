<?php
include("../Connections/conn_alimentos.php");

$consulta   =   "
                SELECT  *
                FROM vw_doacoes
                ORDER BY nome_alimento
                ";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Doações</title>
    <!-- Link CSS do Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Link para CSS Específico -->
    <link rel="stylesheet" href="../css/meu_estilo.css">
</head>
<body class="fundofixo">
    <main class="container">
        <h1 class="breadcrumb alert-success text-center">Lista de Doações</h1>
        <div class="btn btn-success disabled">
            Total de Produtos:
        </div>
        <table class="table table-hover table-condensed tbopacidade">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Instituição</th>
                    <th>Alimento</th>
                    <th>Quantidade</th>
                    <th>Validade</th>
                    <th>Endereço</th>
                    <th>IMAGEM</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </main>
<!-- Link arquivos Bootstrap js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>    
</body>
</html>
