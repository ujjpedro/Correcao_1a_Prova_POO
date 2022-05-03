<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cadastro Pessoa Fisica</title>
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
    $seletor = "PessoaFisica";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $seletor);
    }
    $pf_id = isset($_POST['pf_id']) ? $_POST['pf_id'] : "";
    $pf_cpf = isset($_POST['pf_cpf']) ? $_POST['pf_cpf'] : "";
    $pf_nome = isset($_POST['pf_nome']) ? $_POST['pf_nome'] : "";
    $pf_dt_nascimento = isset($_POST['pf_dt_nascimento']) ? $_POST['pf_dt_nascimento'] : "";
?>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <content>
    <form action="acao.php" method="post" id="form" style="padding-left: 5vw; padding-right: 5vw;">
        <h1>Cadastro Pessoa Fisica</h1>
        <br>
        <div class="form-group">
        <label for="">CPF:</label>
        <input type="number" class="form-control" required name="pf_cpf" id="pf_cpf" placeholder="Digite o cpf" value="<?php if ($comando == "update"){echo $dados['pf_cpf'];}?>" minlength="11" maxlength="11">
        </div>
        <br>
        <div class="form-group">
        <label for="">Nome:</label>
        <input type="text" class="form-control" required name="pf_nome" id="pf_nome" placeholder="Digite o nome" value="<?php if ($comando == "update"){echo $dados['pf_nome'];}?>">
        </div>
        <br>
        <div class="form-group">
        <label for="">Nascimento:</label>
        <input type="date" class="form-control" required name="pf_dt_nascimento" id="pf_dt_nascimento" placeholder="Digite a data de nascimento" value="<?php if ($comando == "update"){echo $dados['pf_dt_nascimento'];}?>">
        </div>
        <br>
        <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
        <input type="hidden" id="seletor" name="seletor" class="seletor" value="PessoaFisica">
        <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
        <button type="submit" class="btn btn-dark" id="acao" value="ENVIAR">Enviar</button>
    </form>
    </content>
    <footer class="" id="">
    </footer>
</body>
</html>