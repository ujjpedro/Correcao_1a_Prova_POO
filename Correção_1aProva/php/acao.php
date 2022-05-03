<?php
    $comando = "";
    if(isset($_POST['comando'])){$comando = $_POST['comando'];}else if(isset($_GET['comando'])){$comando = $_GET['comando'];}
    $seletor = "";
    if(isset($_POST['seletor'])){$seletor = $_POST['seletor'];}else if(isset($_GET['seletor'])){$seletor = $_GET['seletor'];}

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    acao($comando, $seletor);

    function acao($acao, $seletor){
        if($seletor == "operacao"){
            require_once "../classes/conta_corrent.class.php";
            if($_POST['cc_operacao'] == "saque"){
                $dados;
                $dados = buscarDados($_POST['cc_numero'], "ContaCorrente");
                $contaCorrente = new ContaCorrente($_POST['cc_numero'], $dados['cc_saldo'], $_POST['cc_pf_id'], "");
                $contaCorrente->saque($_POST['cc_valor']);
                header("location:index_conta_corrent.php");
            } else if($_POST['cc_operacao'] == "deposito"){
                $dados;
                $dados = buscarDados($_POST['cc_numero'], "ContaCorrente");
                $contaCorrente = new ContaCorrente($_POST['cc_numero'], $dados['cc_saldo'], $_POST['cc_pf_id'], "");
                $contaCorrente->deposito($_POST['cc_valor']);
                header("location:index_conta_corrent.php");
            }
        }

        else if($seletor == "PessoaFisica"){
            require_once "../classes/pessoa_fisica.class.php";
        } else if($seletor == "ContaCorrente"){
            require_once "../classes/conta_corrent.class.php";
        } else if($seletor == "Contatos"){
            require_once "../classes/contatos.class.php";
        }
        if($acao == "insert"){
            try{
            if($seletor == "PessoaFisica"){
                $pessoaFisica = new PessoaFisica("", $_POST['pf_cpf'], $_POST['pf_nome'], $_POST['pf_dt_nascimento'],);
                $pessoaFisica->inserir();
                header("location:index_pessoa_fisica.php");
            } else if($seletor == "ContaCorrente") {
                $contaCorrente = new ContaCorrente("", $_POST['cc_saldo'], $_POST['cc_pf_id'], $_POST['cc_dt_ultima_alteracao']);
                $contaCorrente->inserir();
                header("location:index_conta_corrent.php");
            } else if($seletor == "Contatos") {
                $contatos = new Contatos("", $_POST['cont_tipo'], $_POST['cont_descricao'], $_POST['cont_pf_id']);
                $contatos->inserir();
                header("location:index_contatos.php");
            }
        } catch(Exception $e){
            echo "<h1>Erro ao cadastrar a conta.</h1>
            <br> Erro:".$e->getMessage();
        }
        } else if($acao == "deletar"){
        try{
            if($seletor == "PessoaFisica"){
                $pessoaFisica = new PessoaFisica($_GET['id'], "", "", "");
                $pessoaFisica->deletar();
                header("location:index_pessoa_fisica.php");
            } else if($seletor == "ContaCorrente") {
                $contaCorrente = new ContaCorrente($_GET['id'], "", "", "");
                $contaCorrente->deletar();
                header("location:index_conta_corrent.php");
            } else if($seletor == "Contatos") {
                $contatos = new Contatos($_GET['id'], "", "", "");
                $contatos->deletar();
                header("location:index_contatos.php");
            }
        } catch(Exception $e){
            echo "<h1>Erro ao cadastrar a conta.</h1>
            <br> Erro:".$e->getMessage();
        }
        } else if($acao == "update"){
        try{
            if($seletor == "PessoaFisica"){
                $pessoaFisica = new PessoaFisica($_POST['id'], $_POST['pf_cpf'], $_POST['pf_nome'],  $_POST['pf_dt_nascimento']);
                $pessoaFisica->atualizar();
                header("location:index_pessoa_fisica.php");
            } else if($seletor == "ContaCorrente"){
                $contaCorrente = new ContaCorrente($_POST['id'], $_POST['cc_saldo'], $_POST['cc_pf_id'], $_POST['cc_dt_ultima_alteracao']);
                $contaCorrente->atualizar();
                header("location:index_conta_corrent.php");
            } else if($seletor == "Contatos"){
                $contatos = new Contatos($_POST['id'], $_POST['cont_tipo'], $_POST['cont_descricao'],  $_POST['cont_pf_id']);
                $contatos->atualizar();
                header("location:index_contatos.php");
            }
        } catch(Exception $e){
            echo "<h1>Erro ao cadastrar a conta.</h1>
            <br> Erro:".$e->getMessage();
        }
        }
    }

    function buscarDados($id,$seletor){
        $pdo = Conexao::getInstance();
        $dados = array();
    if($seletor == 'PessoaFisica'){
        $consulta = $pdo->query("SELECT * FROM pessoa_fisica WHERE pf_id = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['pf_cpf'] = $linha['pf_cpf'];
            $dados['pf_nome'] = $linha['pf_nome'];
            $dados['pf_dt_nascimento'] = $linha['pf_dt_nascimento'];
        }
    } else if($seletor == 'ContaCorrente'){
        $consulta = $pdo->query("SELECT * FROM conta_corrente, pessoa_fisica WHERE cc_numero = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['cc_saldo'] = $linha['cc_saldo'];
            $dados['cc_pf_id'] = $linha['cc_pf_id'];
            $dados['cc_dt_ultima_alteracao'] = $linha['cc_dt_ultima_alteracao'];
        }
    } else if($seletor == 'Contatos'){
        $consulta = $pdo->query("SELECT * FROM contatos, pessoa_fisica WHERE cont_id = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['cont_tipo'] = $linha['cont_tipo'];
            $dados['cont_descricao'] = $linha['cont_descricao'];
            $dados['cont_pf_id'] = $linha['cont_pf_id'];
        }
    }
        return $dados;
    }
    
    require_once("../classes/pessoa_fisica.class.php");
    function exibir($chave, $dado){
        $str = 0;
        foreach($dado as $linha){
            $str .= "<option value='".$linha[$chave[0]]."'>".$linha[$chave[1]]."</option>";
        }
        return $str;
    }


    function lista_pessoa($id){
        $pessoaFisica = new PessoaFisica("","","","");
        $lista = $pessoaFisica->buscarPessoa($id);
        return exibir(array('pf_id', 'pf_nome'), $lista);

    }

    require_once("../classes/conta_corrent.class.php");
    function lista_conta($id){
        $pessoaFisica = new ContaCorrente("","","","");
        $lista = $pessoaFisica->buscarConta($id);
        return exibir(array('cc_numero', 'cc_numero'), $lista);

    }
?>