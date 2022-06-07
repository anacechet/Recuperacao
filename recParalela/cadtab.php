<!DOCTYPE html>
<?php
    include_once "processa1.php";
    $processa1 = isset($_GET['processa1']) ? $_GET['processa1'] : "";
    if ($processa1 == 'editar'){
        $idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : "";
    if ($idTabuleiro > 0)
        $dados = buscarDados($idTabuleiro);
}
    $title = "Cadastro";
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

        <h3>Insira os dados</h3><hr>
            <form method="post" action="processa1.php">
                
            <p>ID:</p>
                <input class="form-control btn-sm" readonly  type="text" name="idTabuleiro" id="idTabuleiro" value="<?php if ($processa1 == "editar") echo $dados['idTabuleiro']; else echo 0; ?>"><br>

            <p>Lado:</p>
                <input class="form-control btn-sm" name="LadoTabuleiro" id="LadoTabuleiro" type="text" required="true" value="<?php if ($processa1 == "editar") echo $dados['LadoTabuleiro']; ?>"><hr>    
            
            <button name="processa1" value="salvar" id="processa1" type="submit" class="btn btn-outline-success btn-sm">Salvar</button><br>
            </form>
</div>
</div>
</div>
</body>
</html>