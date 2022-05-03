<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cadastro Contatos</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/cadastro.css'>
    <script src='../js/main.js'></script>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>
<body>
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "acao.php";
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $seletor = "Contatos";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $seletor);
    }
    $cont_id = isset($_POST['cont_id']) ? $_POST['cont_id'] : "";
    $cont_tipo = isset($_POST['cont_tipo']) ? $_POST['cont_tipo'] : "";
    $cont_descricao = isset($_POST['cont_descricao']) ? $_POST['cont_descricao'] : "";
    $cc_pf_id = isset($_POST['cc_pf_id']) ? $_POST['cc_pf_id'] : "";
?>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
    <form action="acao.php" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
        <h1>Cadastro Contatos</h1>
        <br>
        <div class="form-group">
        <label for="">Tipo:</label>
        <input type="text" class="form-control" required type="text" name="cont_tipo" id="cont_tipo" placeholder="Digite o tipo" value="<?php if ($comando == "update"){echo $dados['cont_tipo'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">Descrição:</label>
        <input type="text" class="form-control" required type="text" name="cont_descricao" id="cont_descricao" placeholder="Digite a descrição" value="<?php if ($comando == "update"){echo $dados['cont_descricao'];}?>">
        </div>
        <br>
        <label class="formItem formText" id="">Pessoa física:</label>
        <select class="form-select" aria-label="Escolha a pessoa física" name="cont_pf_id" value="">  
            <?php
                require_once("acao.php");
                echo lista_pessoa(0);
            ?>
        </select>
        <br>
        <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
        <input type="hidden" id="seletor" name="seletor" class="seletor" value="Contatos">
        <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
        <button type="submit" class="btn btn-dark" id="acao" value="ENVIAR">Enviar</button>
    </form>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>