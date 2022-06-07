<!DOCTYPE html>
<html lang="pt-br">

    <?php 
    
        require_once "classe/tabuleiro.class.php";
        require_once  "conf/Conexao.php";
        require_once  "processa1.php";
        $title = "Tabuleiros";
        $procurar = isset($_GET["procurar"]) ? $_GET["procurar"] : ""; 
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;

    ?>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
</head> 

<body>

    <ul class="menu">
        <li class="menu1"><a href="tabuleiro.php" class="menu1">TABULEIROS</a></li>
        <li class="menu2"><a href="quadrado.php" class="menu2">QUADRADOS</a></li>
        <li class="menu2"><a href="usuario.php" class="menu2">USUÁRIO</a></li> 
        <li class="menu2"><a href="login.php" class="menu2">LOGIN</a></li> 
    </ul>

    <div class="margem">
        <div class="cor">
            <div class="form">
    
            <form method="post" action="processa1.php">

                <h3>Criar Tabuleiro</h3><br>
                <input type="hidden" name="idTabuleiro" id="idTabuleiro" size="25" value="0">
                <p>Valor dos Lados</p>
                <input type="text" name="LadoTabuleiro" id="LadoTabuleiro" class="form-control btn-sm" size="25" value=""><br><br>
                <button name="processa1" id="processa1" value="salvar" type="submit"  class="btn btn-outline-success btn-sm">Salvar</button><br>  
            
            </form>

            </div>
            <br>

        <div class="form">
        
            <form method ="get">

                <h3>Procurar Tabuleiro</h3>
                <input type="text" name="procurar" id="procurar" size="50" class="form-control btn-sm" value="<?php echo $procurar;?>"> <br>
                <p> Pesquisar por:</p>
                <input type="radio" name="tipo" value="1" class="form-check-input" <?php if ($tipo == "1") echo "checked" ?>>ID<br>
                <input type="radio" name="tipo" value="2" class="form-check-input" <?php if ($tipo == "2") echo "checked" ?>>Lado<br>
                <button name="buscar " id="buscar" value="buscar" type="submit"  class="btn btn-outline-success btn-sm">Procurar</button><br>
            
        </form>
        </div><br>

        <table class="table table-hover table-dark table-striped">

            <tr>
                <td><b>ID</b></td>
                <td><b>Lado</b></td>
                <td><b>Editar</b></td>
                <td><b>Show</b></td>
                <td><b>Excluir</b></td>
            </tr>

            <?php  
            $tab = new Tabuleiro(0, 0);
            $lista = $tab->listarTabuleiro($tipo, $procurar);
            foreach ($lista as $linha) {
            ?>

        <tr>
            <th scope="row"><?php echo $linha['idTabuleiro'];?></th>
            <th scope="row"><?php echo $linha['LadoTabuleiro'];?></th>
            <td>
                <a href='cadtab.php?processa1=editar&idTabuleiro=<?php echo $linha['idTabuleiro'];?>'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                </a>
            </td>

            <td scope="row">
                <a href="consulta1.php?idTabuleiro=<?php echo $linha['idTabuleiro']; ?>&LadoTabuleiro=<?php echo $linha['LadoTabuleiro'];?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                </a>
            </td>

            <td>
                <?php echo " <a href='processa1.php?processa1=excluir&idTabuleiro={$linha['idTabuleiro']}')>";?>
                <?php echo " <a href='processa1.php?processa1=excluir&idTabuleiro={$linha['idTabuleiro']}')>";?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/><path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                    </svg>
                </a>
            </td>
        </tr>

         <?php } ?> 

</body>
</html>