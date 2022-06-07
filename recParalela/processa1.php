<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classe/tabuleiro.class.php");

    $idTabuleiro = isset($_POST['idTabuleiro']) ? $_POST['idTabuleiro'] : 0;   
    $LadoTabuleiro = isset($_POST['LadoTabuleiro']) ? $_POST['LadoTabuleiro'] : 1;


    //Chama o processa.
    $processa1 = isset($_GET['processa1']) ? $_GET['processa1'] : "";
    //Analisa se ação do processa é igual a excluir.
    if ($processa1 == "excluir"){
        $idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : 0;
        //Analisa as informações dentro do processa.
        $tabuleiro = new Tabuleiro($idTabuleiro, 0, 0);
        //exclui a linha selecionada.
        $resultado = $tabuleiro->excluir($idTabuleiro);
        header("location:tabuleiro.php");
    }
   
    //Chama o processa.
    $processa1 = isset($_POST['processa1']) ? $_POST['processa1'] : "";
    //Analisa se ação do processa é igual à salvar.
    if ($processa1 == "salvar"){
        $idTabuleiro = isset($_POST['idTabuleiro']) ? $_POST['idTabuleiro'] : "";
         //Analisa se ID é igual a 0, se for cria novo usuário, se não edita as informações no banco.
        if ($idTabuleiro == 0){
            $tabuleiro = new Tabuleiro("", $_POST['LadoTabuleiro']);                  
            $resultado = $tabuleiro->insere();
            header("location:tabuleiro.php");
        }else {    
        $tabuleiro = new Tabuleiro($_POST['idTabuleiro'], $_POST['LadoTabuleiro']);
        $resultado = $tabuleiro->editar();
        }
        header("location:tabuleiro.php");   
}

//Consulta os dados dentro do banco.
    function buscarDados($idTabuleiro){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM tabuleiro WHERE idTabuleiro = $idTabuleiro");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idTabuleiro'] = $linha['idTabuleiro'];
            $dados['LadoTabuleiro'] = $linha['LadoTabuleiro'];

        }
        return $dados;
    }



?>