<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classe/usuario.class.php");

    $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : 0;   
    $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
    $login = isset($_POST['login']) ? $_POST['login'] : "";
    $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
    

    //Chama o processa.
    $processa2 = isset($_GET['processa2']) ? $_GET['processa2'] : "";
    //Analisa se ação do processa é igual a excluir.
    if ($processa2 == "excluir"){
        $idUsuario = isset($_GET['idUsuario']) ? $_GET['idUsuario'] : 0;
        //Analisa as informações dentro do processa.
        $usuario = new Usuario($idUsuario, 0, "", 0);
        //exclui a linha selecionada.
        $resultado = $usuario->excluir($idUsuario);
        header("location:usuario.php");
    }

    //Chama o processa.
    $processa2 = isset($_POST['processa2']) ? $_POST['processa2'] : "";
    //Analisa se ação do processa é igual à salvar.
    if ($processa2 == "salvar"){
        $idUsuario = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : "";
        //Analisa se o ID é igual a 0, se for cria/insere novo usuário, se não edita as informações no banco.
        if ($idUsuario == 0){
            $usuario = new Usuario("", $_POST['nome'], $_POST['login'], $_POST['senha']);                  
            $resultado = $usuario->insere();
            header("location:usuario.php");
        }else {    
        $usuario = new Usuario($_POST['idUsuario'], $_POST['nome'], $_POST['login'], $_POST['senha']);
        $resultado = $usuario->editar();
        }
        header("location:usuario.php");   
}

//Consulta os dados dentro do banco.
    function buscarDados($idUsuario){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM usuario WHERE idUsuario = $idUsuario");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idUsuario'] = $linha['idUsuario'];
            $dados['login'] = $linha['login'];
            $dados['nome'] = $linha['nome'];
            $dados['senha'] = $linha['senha'];

        }
        return $dados;
    }



?>