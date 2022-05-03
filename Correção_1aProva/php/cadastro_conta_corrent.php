<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cadastro Conta Corrente</title>
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
    $seletor = "ContaCorrente";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $seletor);
    }
    $cc_numero = isset($_POST['cc_numero']) ? $_POST['cc_numero'] : "";
    $cc_saldo = isset($_POST['cc_saldo']) ? $_POST['cc_saldo'] : "";
    $cc_pf_id = isset($_POST['cc_pf_id']) ? $_POST['cc_pf_id'] : "";
    $cc_dt_ultima_alteracao = isset($_POST['cc_dt_ultima_alteracao']) ? $_POST['cc_dt_ultima_alteracao'] : "";
?>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
    <form action="acao.php" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
        <h1>Cadastro Conta Corrente</h1>
        <br>
        <div class="form-group">
        <label for="">Saldo:</label>
        <input type="text" class="form-control" required type="text" name="cc_saldo" id="cc_saldo" placeholder="Digite o saldo" value="<?php if ($comando == "update"){echo $dados['cc_saldo'];}?>">
        </div>
        <br>
        <label class="formItem formText" id="">Pessoa física:</label>
        <select class="form-select" aria-label="Escolha a pessoa física" name="cc_pf_id" value="">  
            <?php
                require_once("acao.php");
                echo lista_pessoa(0);
            ?>
        </select>
        <br>
        <div class="form-group">
        <label for="">Última alteração:</label>
        <input type="date" class="form-control" required type="text" name="cc_dt_ultima_alteracao" id="cc_dt_ultima_alteracao" placeholder="Digite a data da última alteração" value="<?php if ($comando == "update"){echo $dados['cc_dt_ultima_alteracao'];}?>">
        </div>
        <br>
        <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
        <input type="hidden" id="seletor" name="seletor" class="seletor" value="ContaCorrente">
        <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
        <button type="submit" class="btn btn-dark" id="acao" value="ENVIAR">Enviar</button>
    </form>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>