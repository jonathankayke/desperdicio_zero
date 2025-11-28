<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Doações</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/meu_estilo.css">

    <style>
        /* Estilo extra para os subtítulos ficarem bonitos */
        .secao-titulo {
            color: #3c763d;
            /* Um verde escuro para combinar */
            border-bottom: 1px solid #d6e9c6;
            padding-bottom: 10px;
            margin-bottom: 20px;
            font-size: 1.5em;
        }
    </style>
</head>

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
                                        <label for="endereco_empresa" class="form-label">Endereço da Empresa</label>
                                        <input type="text" class="form-control" id="endereco_empresa"
                                            name="endereco_empresa" placeholder="Rua, Número, Bairro, Cidade" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="whatsapp" class="form-label">Contato (WhatsApp)</label>
                                        <input type="tel" class="form-control" id="whatsapp" name="whatsapp"
                                            placeholder="(XX) 9XXXX-XXXX" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="documento" class="form-label">CPF/CNPJ</label>
                                        <input type="text" class="form-control" id="documento" name="documento"
                                            placeholder="CPF ou CNPJ" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="contato@gmail.com" required>
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

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <br>
                                    <button type="submit" class="btn btn-success btn-lg btn-block">
                                        Salvar Doação
                                    </button>
                                </div>
                            </div>

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