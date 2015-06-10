<?php

include ('comum.php');

$con = novaConexao();

$sql = $con->prepare('select * from pessoa');
$sql->execute();
$sql->bind_result($id, $nome, $endereco, $genero, $ativo);
include_once ('comum.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cadastro de pessoas</title>
        <meta charset="ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.11.3.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form class="form-horizontal" method="GET" action="incluir.php">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nome</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome" id="input-nome" class="form-control" placeholder="Nome">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Endere�o</label>
                            <div class="col-sm-10">
                                <input type="text" name="endereco" id="input-endereco" class="form-control" placeholder="Endere�o">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sexo</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input name="sexo" type="radio" value="m" id="opt-masc"> Masculino
                                </label>
                                <label class="radio-inline">
                                    <input name="sexo" type="radio" value="f" id="opt-fem"> Feminino
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="ativo" checked> Ativo
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button class="btn btn-success" id="btn-enviar" type="submit" >Inserir</button>
                                <?php if (isset($_GET['msg'])) { ?>
                                
                                <span><?php echo $_GET['msg']; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <h5>Listagem de pessoas</h5>
                    <ul>
                        <?php
                        while ($sql->fetch()) {
                            if ($genero == 'm') {
                                $genero = 'Masculino';
                            } else if ($genero == 'f') {
                                $genero = 'Feminino';
                            }
                            if ($ativo == 1) {
                                $ativo = 'Sim';
                            } else if ($ativo == 0) {
                                $ativo = 'N�o';
                            }
                            ?>
                            <li>
                                <?php echo $nome; ?> <a class="btn btn-danger">[Deletar]</a>
                                <ul>
                                    <li>Endereco: <?php echo $endereco; ?> </li>
                                    <li>Sexo: <?php echo $genero; ?> </li>
                                    <li>Ativo: <?php echo $ativo; ?> </li>
                                </ul>
                            </li> 
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
        <script>
            $('#btn-enviar').click(function () {
                var valido = true;
                if ($('#input-nome').val() == '') {
                    valido = false;.+
                    
                    
                    alert('Preencha o nome');
                }
                if ($('#input-endereco').val() == '') {
                    valido = false;
                    alert('Preencha o endere�o');
                }
                if (!$('#opt-masc').is(':checked') && !$('#opt-fem').is(':checked')) {
                    valido = false;
                    alert('Escolha um sexo');
                }

                return valido;
            })
            function confirmaDeletar(){
                confirm('Deseja deletar?');
            }
        </script>
    </body>
</html>
