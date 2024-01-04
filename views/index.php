<?php
session_start();
if ($_SESSION['logado'] != true) {
    header("Location: login.php");
    session_destroy();
}

if (isset($_GET['sair'])) {
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
    <script type="text/javascript" src="../easyui/locale/easyui-lang-pt_BR.js"></script>

    <title>Lista Tarefas</title>
</head>

<body style="background-color: rgba(0, 0, 0, 0.63); width: 80%; margin: 0 auto; padding: 10px">
    <!-- 
            <a href="?sair">Sair</a>    
        -->


    <table id="grdTarefas" class="easyui-datagrid" title="Lista de Tarefas" border="true" fit="true" fitColumns="true" pagination="true" singleSelect="true" pageList="[10,20,50,100]" pageSize="50" striped="true" rownumbers="true" toolbar="#pesquisa">

        <thead>
            <tr>
                <th field="id" sortable data-options="align:'center'">N° Tarefa</th>
                <th field="nome_tarefa" width="150" sortable data-options="align:'center'">Tarefa</th>
                <th field="prioridade" width="100" sortable data-options="align:'center'">Prioridade</th>
                <th field="status" width="150" sortable data-options="align:'center'">Status</th>
                <th field="usuario_criacao" width="200" sortable data-options="align:'center'">Usuário de Criação</th>
                <th field="criacao_datahora" width="200" sortable data-options="align:'center'">Data de Criação</th>
                <th field="vencimento" width="200" sortable data-options="align:'center'">Data de Vencimento</th>
            </tr>
        </thead>

    </table>

    <div id="pesquisa" style="padding:5px; width:100%;">
        <a href="#" id="btnFiltros" class="easyui-linkbutton col-b" data-options="iconCls:'icon-filter'" onclick="$('#dlgFiltros').dialog('open')">Filtrar</a>
        <!--
                <a href="#" class="easyui-linkbutton col-b" data-options="iconCls:'icon-search'" onclick="$('#dlgFiltros').dialog('open')">Pesquisar</a>
            -->
        <a href="#" class="easyui-linkbutton col-b" id="btnAdicionar" data-options="iconCls:'icon-add'" onclick="$('#dlgAdicionar').dialog('open')">Adicionar</a>

        <a href="?sair" class="easyui-linkbutton col-b">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
            </svg>
            Sair
        </a>
    </div>

    <div id="dlgFiltros" class="easyui-dialog" style="padding: 5px; width: 700px;" title="Filtros" modal="true" buttons="#dlgFiltros-buttons" closed="true">
        <table class="ftable">
            <tr>
                <td style="width: 223px; height: 350px; padding-left: 5px;">
                    <table id="dlgFiltrosPrioridade" class="easyui-datagrid" url='../tarefas/lista_prioridades.php' loadMsg="Carregando..." fitColumns="true" fit="true">
                        <thead>
                            <tr>
                                <th field="ck" checkbox="true"></th>
                                <th field="descricao" width="150px">Situação</th>
                            </tr>
                        </thead>
                    </table>
                </td>

                <td style="width: 223px; height: 350px; padding-left: 5px;">
                    <table id="dlgFiltrosStatus" class="easyui-datagrid" url='../tarefas/status_tarefa.php' loadMsg="Carregando..." fitColumns="true" fit="true">
                        <thead>
                            <tr>
                                <th field="ck" checkbox="true"></th>
                                <th field="descricao" width="150px">Status</th>
                            </tr>
                        </thead>
                    </table>
                </td>

                <td style="width: 223px; height: 350px; padding-left: 5px;">
                    <table id="dlgFiltrosUsuario" class="easyui-datagrid" url='../tarefas/lista_usuarios.php' loadMsg="Carregando..." fitColumns="true" fit="true">
                        <thead>
                            <tr>
                                <th field="ck" checkbox="true"></th>
                                <th field='criacao_usuario' width="150px">Usuário de Criação</th>
                            </tr>
                        </thead>
                    </table>
                </td>
            </tr>
            <div id="dlgFiltros-buttons">
                <a href="#" class="easyui-linkbutton col-b" id="btnLimparFiltros" style="margin: 5px; width: 100px; float: right;">Limpar Filtros</a>
                <a href="#" class="easyui-linkbutton col-b" onclick="filtrarTarefas()" style="margin: 5px; width: 100px; float: right;">Filtrar</a>
            </div>
        </table>
    </div>

    <div id="dlgAdicionar" class="easyui-dialog" style="padding: 5px; width: 700px;" title="Adicionar Tarefa" modal="true" buttons="#dlgAdicionar-buttons" closed="true">
        <form id="frmAdicionar" method="POST">
            <label>
                Tarefa <br>
                <input class="easyui-combobox col-2" name="tarefa" id="cbxTarefa" required data-options="url:'../tarefas/lista_tarefas.php', valueField:'id', textField:'nome_tarefa'">
            </label>

            <label>
                Prioridade <br>
                <input class="easyui-combobox col-2" name="prioridade" id="cbxPrioridade" required data-options="url:'../tarefas/lista_prioridades.php', valueField:'descricao', textField:'descricao'">
            </label>

            <label>
                Status <br>
                <input class="easyui-combobox col-2" name="status" id="cbxStatus" required data-options="url:'../tarefas/status_tarefa.php', valueField:'descricao', textField:'descricao'">
            </label>

            <label>
                Data de Vencimento <br>
                <input class="easyui-datebox col-2" name="data_vencimento" id="dtpDataVencimento" required>
            </label>

            <div id="dlgAdicionar-buttons">
                <a href="#" class="easyui-linkbutton col-b" id="btnAdicionarTarefa" style="margin: 5px; width: 100px; float: right;">Adicionar</a>
                <a href="#" class="easyui-linkbutton col-b" id="btnCancelar" style="margin: 5px; width: 100px; float: right;">Cancelar</a>
            </div>
        </form>
    </div>


    <script>
        $(document).ready(function() {
            $('#grdTarefas').datagrid({
                url: '../tarefas/buscarTarefas.php',
            })
        })

        $('#btnAdicionarTarefa').click(function() {
            
            var url = '../controllers/criar_tarefa.php?nome_tarefa=' + $('#cbxTarefa').combobox('getValue') + '&prioridade=' + $('#cbxPrioridade').combobox('getValue') + '&status=' + $('#cbxStatus').combobox('getValue') + '&data_vencimento=' + $('#dtpDataVencimento').datebox('getValue');

            if($('#cbxTarefa').combobox('getValue') && $('#cbxPrioridade').combobox('getValue') && $('#cbxStatus').combobox('getValue') && $('#dtpDataVencimento').datebox('getValue') !== '') {
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        
                        if (data && data.success === true) {
                            $('#frmAdicionar').form('clear');
                            $('#dlgAdicionar').dialog('close');
                            $('#grdTarefas').datagrid('reload');
                            $.messager.alert('Sucesso', data.msg_t, 'info');
                        }
                    },
                })
            } else{
                $.messager.alert('Erro', 'Preencha todos os campos!', 'error');
            }
        })

        $('#btnCancelar').click(function(){
            $('#frmAdicionar').form('clear');
            $('#dlgAdicionar').dialog('close');
        })


        function filtrarTarefas() {
            filtroSituacao = '';
            filtroStatus = '';
            filtroUsuario = '';

            rowsSituacao = $('#dlgFiltrosPrioridade').datagrid('getSelections');
            rowsStatus = $('#dlgFiltrosStatus').datagrid('getSelections');
            rowsUsuario = $('#dlgFiltrosUsuario').datagrid('getSelections');

            for (var i = 0; i < rowsSituacao.length; i++) {
                filtroSituacao += "'" + rowsSituacao[i].descricao + "',";
            }

            for (var i = 0; i < rowsStatus.length; i++) {
                filtroStatus += "'" + rowsStatus[i].descricao + "',";
            }

            for (var i = 0; i < rowsUsuario.length; i++) {
                filtroUsuario += "'" + rowsUsuario[i].criacao_usuario + "',";
            }

            filtroSituacao = filtroSituacao.substring(0, (filtroSituacao.length - 1));
            filtroStatus = filtroStatus.substring(0, (filtroStatus.length - 1));
            filtroUsuario = filtroUsuario.substring(0, (filtroUsuario.length - 1));

            $('#grdTarefas').datagrid({
                url: '../tarefas/buscarTarefas.php?prioridade=' + filtroSituacao + '&status=' + filtroStatus + '&criacao_usuario=' + filtroUsuario
            })
            $('#dlgFiltros').dialog('close');
        }

        $('#btnLimparFiltros').click(function() {
            $('#dlgFiltrosPrioridade').datagrid('clearSelections');
            $('#dlgFiltrosStatus').datagrid('clearSelections');
            $('#dlgFiltrosUsuario').datagrid('clearSelections');
            $('#dlgFiltros').dialog('close');
            $('#grdTarefas').datagrid({
                url: '../tarefas/buscarTarefas.php'
            })
        })
    </script>
</body>

</html>