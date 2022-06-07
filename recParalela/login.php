<!DOCTYPE html>
<?php
    session_start();

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    include_once "classe/usuario.class.php";
 
    $login = isset($_POST["login"]) ? $_POST["login"] : "";     
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : ""; 
    $title = "Login";

?>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/estilo.css">
    <title><?php echo $title ?></title>
</head>
<ul class="menu">
          <li class="menu1"><a href="tabuleiro.php" class="menu1">TABULEIROS</a></li>
        <li class="menu2"><a href="quadrado.php" class="menu2">QUADRADOS</a></li>
        <li class="menu2"><a href="usuario.php" class="menu2">USUÁRIO</a></li> 
        <li class="menu2"><a href="login.php" class="menu2">LOGIN</a></li> 
</ul>

<div class="margem">
<div class="cor">

<div class="form">
    <fieldset>
        <h3 class = "diminui">Insira os dados</h3>
            <form method="post" action="login.php?acao=login">
           <hr> <p>Login</p>
                <input class="form-control btn-sm" class="form-control" name="login" id="login" type="text" required="true"><br>
           <hr> <p>Senha</p>
            <input class="form-control btn-sm" class="form-control" name="senha" id="senha" type="text" required="true"><br><hr>
            <button value="logar" type="submit" class="btn btn-outline-success btn-sm">Logar</button>
            </form>

        <?php
            error_reporting(0);
            if($_GET['acao'] == 'login'){
                $user = new Usuario("","","","");
                if ($user->efetuarLogin($login, $senha) == true){
                    echo "Login efetuado";
                }else if($_SESSION['nome'] == null){
                    echo "Erro, verifique os dados e tente novamente.";
                }
            }
        ?>
            </fieldset></div></div></div>

    
</body>
</html>