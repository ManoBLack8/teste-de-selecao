<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- CABEÇALHO -->
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="100";url="index.php">
    <title>Estda.com</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/jquery.scrollUp.min.css" type="text/css">
</head>
<body>
<div class="container">
            <form id="form" method="POST">
                <div class="modal-body">
                <?php 
                // CONECTANDO AO BANCO DE DADOS
                require_once("conexao.php");
                  if (@$_GET['funcao'] == 'editar') {
                    $id2 = $_GET['id'];
           
                    //RECUPERANDO DADOS DO BANCO DE DADOS
                    $query = $pdo->query("SELECT * FROM alunos where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $id_aluno = $res[0]['id'];
                    $nome2 = $res[0]['nome'];
                    $email2 = $res[0]['email'];
                    $telefone2 = $res[0]['telefone'];
                    $data2 = $res[0]['nascimento'];
                    $escola2 = $res[0]['escola'];
                    $genero2 = $res[0]['genero'];

                    






                                        

                } else {
                    $titulo = "Inserir Registro";

                }


                ?>

                   <!-- SE ESTIVER NA AÇÃO DE EDIÇÃO OS RESULTADO APARECM NOS INPUTS -->
                    <div class="form-group">
                        <label >ID</label>
                        <input value="<?php echo @$id_aluno ?>" type="text" class="form-control" id="id-alunos" name="id-alunos" >
                    </div>
                    <div class="form-group">
                        <label >NOME</label>
                        <input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="nome-alunos" name="nome-alunos" >
                    </div>
                    <div class="form-group">
                        <label >DATA DE NASCIMENTO</label>
                        <input value="<?php echo @$data2 ?>" type="date" class="form-control" id="cep" name="nascimento" >
                    </div>
                    <!-- não consegui mostrar o resultado no select por falta de tempo-->
                    <div class="form-group">
                    <select id="genero" name="genero">
                        <option value="genero">Selecione seu genero:</option> 
                        <option value="masculino">Masculino</option>
                        <option value="feminino">Feminino</option>
                        <option value="outros">Outros</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label>TELEFONE</label>
                        <input value="<?php echo @$telefone2 ?>" type="text" class="form-control" id="cidade" name="telefone" >
                    </div>
                    <div class="form-group">
                        <label >EMAIL</label>
                        <input value="<?php echo @$email2 ?>" type="text" class="form-control" id="bairro" name="email" >
                    </div>
                        <input list="browsers" name="escolas" id="browser">
                    <!-- PEGAR ESCOLAS NO BANCO DE DADOS -->
                    <div class="form-group">        
                        <datalist id="browsers">
                            <?php
                             $query = $pdo->query("SELECT * FROM escolas order by id desc ");
                             $res = $query->fetchAll(PDO::FETCH_ASSOC);
                             for ($i=0; $i < count($res); $i++) { 
                             foreach ($res[$i] as $key => $value) {
                             }
                            
                             $nome_escola = $res[$i]['nome'];

                            ?>


                            <option value="<?php echo $nome_escola ?>">
                            <?php } ?>
                        </datalist>
                    </div>    
                    <div id="mensagem-i"></div>
                    <button>Cancelar</button>
                    <button id="btncaalunos" name="btncaescola" >Cadastrar</button>
                    

                    
            </form>


    
    
    </div>
</body>

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
<!-- AJAX PARA SUBIR INFORMAÇÕES DO FORMULÁRIO -->
<script type="text/javascript">
    $('#btncaalunos').click(function(event) {
    event.preventDefault();
    $('#mensagem-i').removeClass('text-success')
    $('#mensagem-i').removeClass('text-danger')
    $('#mensagem-i').addClass('text-info')
     $('#mensagem-i').text('Enviando...')
    $.ajax({
        url:"back_alunos.php",
        method:"post",
        data: $('form').serialize(),
        dataType: "text",
        success: function(msg) {
            if (msg.trim() === 'Enviado com Sucesso!') {
                $('#mensagem-i').removeClass('text-info')
                $('#mensagem-i').addClass('text-success')
                $('#mensagem-i').text(msg);
                $('#nomecontato').val('');
                $('#emailcontato').val('');
                $('#msgcontato').val('');
            }

            else{
                $('#mensagem-i').text(msg)

            }
        }
    })

})
</script>
