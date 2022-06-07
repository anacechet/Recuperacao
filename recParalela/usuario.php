<!DOCTYPE html>
<html lang="pt-br">

    <?php 
        require_once "classe/usuario.class.php";
        require_once  "conf/Conexao.php";
        require_once  "processa2.php";
        $title = "Usuarios";
        $procurar = isset($_GET["procurar"]) ? $_GET["procurar"] : ""; 
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;
    ?>

<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
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

                <form method="post" action="processa2.php">

                <h3>Novo Usuário</h3><br>
                <input type="hidden" name="idUsuario" id="idUsuario" size="25" value="0">
                <p>Insira o nome</p><input class="form-control btn-sm" type="text" name="nome" id="nome" size="25" value=""><br>
                <p>Insira o login</p><input class="form-control btn-sm" type="text" name="login" id="login" size="25" value=""><br>
                <p>Insira a senha</p><input class="form-control btn-sm" type="password " name="senha" id="senha" size="25" value=""><br>
                <button name="processa2" id="processa2" value="salvar" type="submit"  class="btn btn-outline-success btn-sm">Salvar</button><br>  

                </form>

            </div><br>

    

            <div class="form">
                <form method ="get">

                    <h3>Procurar Usuário</h3>
                    <input type="text" name="procurar" id="procurar" size="50" class="form-control btn-sm" value="<?php echo $procurar;?>"> <br>
                    <p> Pesquisar por:</p>
                    <input type="radio" name="tipo" value="1" class="form-check-input" <?php if ($tipo == "1") echo "checked" ?>>ID<br>
                    <input type="radio" name="tipo" value="2" class="form-check-input" <?php if ($tipo == "2") echo "checked" ?>>Nome<br>
                    <button name="buscar " id="buscar" value="buscar" type="submit"  class="btn btn-outline-success btn-sm">Procurar</button><br> 

                </form>
            </div><br>

            <table class="table table-hover table-dark table-striped">
            
                <thead>
                    <td scope="col"><b>ID</b></td>
                    <td scope="col"><b>Nome</b></td>
                    <td scope="col"><b>Login</b></td>
                    <td scope="col"><b>Senha</b></td>
                    <td scope="col"><b>Editar</b></td>
                    <td scope="col"><b>Excluir</b></td>
                </tr>
                </thead>

            <tbody>
            
            <?php  
            $usu = new Usuario(0, "", "", "");
            $lista = $usu->listarUsuario($tipo, $procurar);
            foreach ($lista as $linha) { 
            ?>

            <tr>
                <th scope="row"><?php echo $linha['idUsuario'];?></th>
                <th scope="row"><?php echo $linha['nome'];?></th>
                <th scope="row"><?php echo $linha['login'];?></th>
                <th scope="row"><?php echo $linha['senha'];?></th>
                <td>
                    <a href='cadus.php?processa2=editar&idUsuario=<?php echo $linha['idUsuario'];?>'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/><path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </a>
                </td>
                
                <td>
                    <?php echo " <a href='processa2.php?processa2=excluir&idUsuario={$linha['idUsuario']}')>";?>
                    <?php echo " <a href='processa2.php?processa2=excluir&idUsuario={$linha['idUsuario']}')>";?> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/><path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
                        </svg></a>
                </td>
            </tr>
            <?php } ?> 
                
            </tbody>
            
            </table>
        </div>
    </div>

</body>
</html>