<?php

require_once("../../app_lista_tarefas/conexao.php");
require_once("../../app_lista_tarefas/tarefa.model.php");
require_once("../../app_lista_tarefas/tarefa.service.php");

$acao = isset($_GET["acao"]) ? $_GET["acao"] : $acao;

//print_r($acao); 

if ($acao == 'inserir') {
    $tarefa = new Tarefa();
    $tarefa->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->inserir();


    header('Location: nova_tarefa.php?inclusao=1');

} else if ($acao == 'recuperar') {

    $tarefa = new Tarefa();
    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $lista = $tarefaService->recuperar();


} else if ($acao == 'atualizar') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_POST['id'])->__set('tarefa', $_POST['tarefa']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->atualizar();

    if ($tarefaService->atualizar()) {
        header('location:todas_tarefas.php?atualizacao=1');
    }


} else if ($acao == 'remover') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id']);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->remover();

    header('location:todas_tarefas.php?atualizacao=2');
}

else if ($acao == 'marcarRealizada') {

    $tarefa = new Tarefa();
    $tarefa->__set('id', $_GET['id'])
        ->__set('id_status', 2);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $tarefaService->marcarRealizada();


    header('location:todas_tarefas.php?atualizacao=3');
}

else if ($acao == 'recuperarPendentes') {

    $tarefa = new Tarefa();
    $tarefa->__set('id_status', 1);

    $conexao = new Conexao();

    $tarefaService = new TarefaService($conexao, $tarefa);
    $lista = $tarefaService->recuperarPendentes();

   }





?>