<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "Contatos";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "cont_id";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <style>
    </style>
</head>
<body class="">
    <?php include_once "menu.php"; ?>
    <form method="post" style="padding-left: 5vw; padding-right: 5vw;">
        <input type="radio" id="cont_id" name="busca" value="cont_id" <?php if($busca == "cont_id"){echo "checked";}?>>
        <label for="huey"><h3>#ID</h3></label>
        <br>
        <input type="radio" id="cont_tipo" name="busca" value="cont_tipo" <?php if($busca == "cont_tipo"){echo "checked";}?>>
        <label for="huey"><h3>Tipo</h3></label>
        <br>
        <input type="radio" id="pf_nome" name="busca" value="pf_nome" <?php if($busca == "pf_nome"){echo "checked";}?>>
        <label for="huey"><h3>#ID Pessoa física</h3></label>
        <br><br>
        <div class="" style="padding-left: 5vw;">
            <legend>Procurar: </legend>
            <input type="text" style="width: 30vw;" name="procurar" id="procurar" value="<?php echo $procurar;?>">
            <button type="submit" class="btn btn-dark" name="acao" id="acao">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            </button>
            <br><br>
        </div>
    </form>
    <div class="">
        <table class="table table-striped" style="background-color: #FFF;">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#ID</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Pessoa física</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "pf_nome" && $busca != "cont_id"){
                    $type = "<=";
                    $procurar = ($_POST["procurar"]);
                    if(is_numeric($procurar) == false){
                        $procurar = 0;
                    }
                }
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM pessoa_fisica, contatos
                                        WHERE $busca $type $procurar
                                        AND contatos.cont_pf_id = pessoa_fisica.pf_id
                                        ORDER BY $busca");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['cont_id'];?></th>
                    <td scope="row"><?php echo $linha['cont_tipo'];?></td>
                    <td scope="row"><?php echo $linha['cont_descricao'];?></td>
                    <td scope="row"><?php echo $linha['pf_nome'];?></td>
                    <td scope="row"><a href="cadContatos.php?id=<?php echo $linha['cont_id'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 3vw;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao.php?id=<?php echo $linha['cont_id'];?>&seletor=Contatos&comando=deletar"><img src="../img/trash.svg" style="width: 3vw;"></a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>