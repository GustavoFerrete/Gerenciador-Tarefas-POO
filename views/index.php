<?php
session_start();
if($_SESSION['logado'] != true) {
    header("Location: login.php");
    session_destroy();
}

if(isset($_GET['sair'])) {
    header("Location: login.php");
    session_destroy();
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

        <title>Lista Tarefas</title>
    </head>

    <body class="login" style="border: 1px solid blue;">

        <div class="container">
            <a href="?sair">Sair</a> <br>
        </div>
        


        
    </body>

</html>