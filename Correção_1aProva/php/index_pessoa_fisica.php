<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "Pessoa Física";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "pf_id";
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
        <input type="radio" id="pf_id" name="busca" value="pf_id" <?php if($busca == "pf_id"){echo "checked";}?>>
        <label for="huey"><h3>Id</h3></label>
        <br>
        <input type="radio" id="pf_nome" name="busca" value="pf_nome" <?php if($busca == "pf_nome"){echo "checked";}?>>
        <label for="huey"><h3>Nome</h3></label>
        <br>
        <input type="radio" id="pf_cpf" name="busca" value="pf_cpf" <?php if($busca == "pf_cpf"){echo "checked";}?>>
        <label for="huey"><h3>CPF</h3></label>
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
                    <th scope="col">CPF</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Data de nascimento</th>
                    <th scope="col">Idade</th>
                    <th scope="col">Alterar</th>
                    <th scope="col">Excluir</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "pf_nome" && $busca != "pf_id"){
                    $type = "<=";
                    $procurar = ($_POST["procurar"]);
                    if(is_numeric($procurar) == false){
                        $procurar = 0;
                    }
                }
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM pessoa_fisica
                                        WHERE $busca $type $procurar
                                        ORDER BY $busca");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $hoje = date("Y");
                $nascimento = date("Y", strtotime($linha['pf_dt_nascimento']));
                $idade = $hoje - $nascimento;
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['pf_id'];?></th>
                    <td scope="row"><?php echo $linha['pf_cpf'];?></td>
                    <td scope="row"><?php echo $linha['pf_nome'];?></td>
                    <td><?php echo date("d/m/Y", strtotime($linha['pf_dt_nascimento']));?></td>
                    <td style="color: <?php if($idade >=18){echo "blue";}else{echo "red";}?>;"><?php echo $idade;?></td>                    
                    <td scope="row"><a href="cadPessoaFisica.php?id=<?php echo $linha['pf_id'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 3vw;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao.php?id=<?php echo $linha['pf_id'];?>&seletor=PessoaFisica&comando=deletar"><img src="../img/trash.svg" style="width: 3vw;"></a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>