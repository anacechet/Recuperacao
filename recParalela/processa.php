<?php
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once("classe/quadrado.class.php");

    $idQuadrado = isset($_POST['idQuadrado']) ? $_POST['idQuadrado'] : 0;   
    $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
    $lado = isset($_POST['lado']) ? $_POST['lado'] : 1;
    $tabuleiro_idTabuleiro = isset($_POST['tabuleiro_idTabuleiro']) ? $_POST['tabuleiro_idTabuleiro'] : 1;

    //Chamar o processa.
    $processa = isset($_GET['processa']) ? $_GET['processa'] : "";
    //Analise se ação do processa é igual a excluir.
    if ($processa == "excluir"){
        $idQuadrado = isset($_GET['idQuadrado']) ? $_GET['idQuadrado'] : 0;
        //Analise as informações dentro do processa.
        $quadrado = new Quadrado($idQuadrado, 0, "", 0);
        //Exclui a linha selecionada.
        $resultado = $quadrado->excluir($idQuadrado);
        header("location:quadrado.php");
    }

    //Chamar o processa.
    $processa = isset($_POST['processa']) ? $_POST['processa'] : "";
    //Analise se ação do processa é igual à salvar.
    if ($processa == "salvar"){
        $idQuadrado = isset($_POST['idQuadrado']) ? $_POST['idQuadrado'] : "";
        //Analise se o ID é igual a 0, se for cria/insere novo usuário, se não edita as informações no banco.
        if ($idQuadrado == 0){
            $quadrado = new Quadrado("", $_POST['lado'], $_POST['cor'], $_POST['tabuleiro_idTabuleiro']);                  
            $resultado = $quadrado->insere();
            header("location:quadrado.php");
        }else {    
        $quadrado = new Quadrado($_POST['idQuadrado'], $_POST['lado'], $_POST['cor'], $_POST['tabuleiro_idTabuleiro']);
        $resultado = $quadrado->editar();
        }
        header("location:quadrado.php");   
}

     //Consulta os dados dentro do banco de dados.
    function buscarDados($idQuadrado){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM quadrado WHERE idQuadrado = $idQuadrado");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['idQuadrado'] = $linha['idQuadrado'];
            $dados['lado'] = $linha['lado'];
            $dados['cor'] = $linha['cor'];
            $dados['tabuleiro_idTabuleiro'] = $linha['tabuleiro_idTabuleiro'];

        }
        return $dados;
    }



?>