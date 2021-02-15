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
    <title>EstUda.com</title>

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
<!-- BOTÃO PARA ADICIONAR ALUNO -->
<div class="container">
  <div class="row">
      <a type="button" class="" href="alunos-cadastro.php">Cadastrar aluno</a>
    
  </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <!-- PARAMETROS DA TABELA -->
            <thead>
                <tr>
                   <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                    // CHAMANDO BANCO DE DADOS
                    require_once("conexao.php");
                   $query = $pdo->query("SELECT * FROM alunos order by id desc ");
                   $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    // CRIANDO LOOP
                   for ($i=0; $i < count($res); $i++) { 
                      foreach ($res[$i] as $key => $value) {
                      }

                    //   CHAMANDO RESULTADOS 
                      $nomep = $res[$i]['nome'];
                      $id = $res[$i]['id'];

                      ?>


                    <tr>
                        <td><?php echo $nomep ?></td>
                        <!-- BOTOES DE AÇÃO -->
                        <td>
                             <a href="?funcao=editar&id=<?php echo $id ?>" ><i class='fa fa-edit'></i></a>
                             <a href="?funcao=excluir&id=<?php echo $id ?>"class="ml-2 text-danger" ><i class='fa fa-trash'></i></a>
                        </td>
                    </tr>
                    <!-- CHAVE PARA FECHAR O LOOP -->
                <?php } ?>
                </tbody>
            </table>

            <!-- MODAL PARA DELETAR -->
            <div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Registro?</p>

                <div align="center" id="mensagem_excluir" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id"  name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>
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

<!--FUNÇÃO PARA ABRIR A MODAL COM A URL -->
<?php if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-deletar').modal('show');</script>";
}

?>
<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-deletar').click(function (event) {
            event.preventDefault();

            $.ajax({
                url: "excluir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function (mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "alunos.php";
                    }

                    $('#mensagem_excluir').text(mensagem)



                },

            })
        })
    })
</script>
