<?php
session_start();

if(isset($_SESSION['logado'])) {
    header("Location: index.php");
    die;
}
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

    <!-- EasyUI -->
    <link rel="stylesheet" type="text/css" href="../easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="../easyui/themes/icon.css">
    <script type="text/javascript" src="../easyui/jquery.min.js"></script>
    <script type="text/javascript" src="../easyui/jquery.easyui.min.js"></script>

    <title>Login</title>

</head>

<body class="login">

    <div class="container">
        <div class="login-container">
            <div class="left">
                <h2>Bem-vindo de volta</h2>
                <p>Entre para continuar</p>
            </div>
            <div class="right">
                <form id="frmLogin" method="POST">
                    <h2 class="title" style="color: white">Login</h2>
                    <input type="text" class="input" id="usuario" name="usuario" placeholder="Nome de usuário" required>
                    <input type="password" class="input" id="senha" name="senha" placeholder="Senha" required>
                    <button type="submit" class="btn" id="btnEntrar">Entrar</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        $('#frmLogin').form({
            url: '../controllers/login.php',

            onSubmit: function() {
                return $(this).form('validate');
            },

            success: function(result) {
                try {
                    if (result.trim() === '') {
                        console.error('Resposta JSON vazia.');
                        return;
                    }
                    
                    result = JSON.parse(result);

                    if (result.success) {
                        console.log('Teste');
                        window.location.replace('index.php');
                    } else {
                        $.messager.alert('Erro', result.msg, 'error');
                    }
                } catch (e) {
                    console.error('Erro ao analisar a resposta JSON:', e);
                }
            }
        });
    </script>

</body>

</html>