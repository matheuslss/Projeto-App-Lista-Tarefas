<?php 

    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';

    require "../app/tarefa.model.php";
    require "../app/tarefa.service.php";
    require "../app/conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir'){
        $tarefa = new Tarefa();

        $tarefa->__set("tarefa", $_POST["tarefa"]);

        $conexao = new Conexao();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->inserir();

        header("location: nova_tarefa.php?inclusao=1");
    } else if ($acao == "recuperar"){
        $conexao = new Conexao();
        $tarefa = new Tarefa();

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperar();
    } else if ($acao == "atualizar") {
        $conexao = new Conexao();
        $tarefa = new Tarefa();
        $tarefa->__set("id", $_POST['id'])
            ->__set("tarefa", $_POST['tarefa']);

        $tarefaService = new TarefaService($conexao, $tarefa);
        if($tarefas = $tarefaService->atualizar()){
            header("location: todas_tarefas.php");
        } 
    } else if ($acao == "remover"){
        $conexao = new Conexao();
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id']);

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->remover();
        header("location: todas_tarefas.php");

    } else if ($acao == "marcarRealizada"){
        $conexao = new Conexao();
        $tarefa = new Tarefa();
        $tarefa->__set('id', $_GET['id'])
            ->__set('id_status', 2);
            
        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefaService->marcarRealizada();
        header("location: todas_tarefas.php");
    } else if ($acao == "recuperarTarefasPendentes"){
        $conexao = new Conexao();
        $tarefa = new Tarefa();
        $tarefa->__set('id_status', 1);

        $tarefaService = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefaService->recuperarTarefasPendentes();
    }
?>