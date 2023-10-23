<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- CSS -->
    <link href="../css/estilo.css" rel="stylesheet" type="text/css">

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <title>Cadastro</title>
</head>

<body style="background-color: rgba(0, 0, 10, 0.95);">
    <div class="container">

        <div id="dlgCadastro">
            <form id="frmCadastro" method="POST" action="../controllers/cadastrar.php">
                <div class="dlgInput">
                    <label style="width:100%;">Nome Completo:</label> <input type="text" name="nome" id="nome" required style="width:100%;">
                    <label style="width:100%;">Usuário:</label> <input type="text" name="usuario" id="usuario" required style="width:100%;">
                    <label style="width:100%;">Senha:</label> <input type="password" name="senha" id="senha" required style="width:100%;">
                    <label style="width:100%;">Confirmar Senha:</label> <input type="password" name="confSenha" id="confSenha" required style="width:100%;">
                </div>

                <div class="dlgBtn" style="display: flex; margin-top: 35px;">
                    <button type="button" id="btnCadastrar" name="btnCadastrar" style="width:45%; margin: 0 auto;">Cadastrar <?php $_SESSION['cadastro'] = 1; ?></button>
                    <button type="button" id="btnLimpar" style="width:45%; margin: 0 auto;">Limpar Campos</button>
                </div>

            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#frmCadastro').submit(function(e) {
                    e.preventDefault();
                    if ($('#senha').val() === $('#confSenha').val()) {
                        if (this.checkValidity()) {
                            console.log('Formulário válido, enviando...');
                            this.submit();
                        } else {
                            alert('Formulário inválido!');
                        }
                    }else{
                        alert('Senhas não conferem!');
                    }
                });

        $('#btnCadastrar').click(function() {
            $('#frmCadastro').submit();
        });

        $('#btnLimpar').click(function() {
            $('#frmCadastro')[0].reset();
        })
        });
    </script>
</body>

</html>