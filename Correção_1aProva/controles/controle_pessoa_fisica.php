<?php
    $comando = "";
    if(isset($_POST['comando'])){$comando = $_POST['comando'];}else if(isset($_GET['comando'])){$comando = $_GET['comando'];}

    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    require_once("../classes/pessoa_fisica.class.php");
    acao($comando, $seletor);

    function acao($acao){
        if($acao == "insert"){
            $pessoaFisica = new PessoaFisica("", $_POST['pf_cpf'], $_POST['pf_nome'], $_POST['pf_dt_nascimento'],);
            $pessoaFisica->inserir();
            header("location:index_pessoa_fisica.php");
        } else if($acao == "deletar"){
            $pessoaFisica = new PessoaFisica($_GET['id'], "", "", "");
            $pessoaFisica->deletar();
            header("location:index_pessoa_fisica.php");
        } else if($acao == "update"){
            $pessoaFisica = new PessoaFisica($_POST['id'], $_POST['pf_cpf'], $_POST['pf_nome'],  $_POST['pf_dt_nascimento']);
            $pessoaFisica->atualizar();
            header("location:index_pessoa_fisica.php");
        }
    }

    function buscarDados($id){
        $pdo = Conexao::getInstance();
        $dados = array();
        $consulta = $pdo->query("SELECT * FROM pessoa_fisica WHERE pf_id = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['pf_cpf'] = $linha['pf_cpf'];
            $dados['pf_nome'] = $linha['pf_nome'];
            $dados['pf_dt_nascimento'] = $linha['pf_dt_nascimento'];
        }
        return $dados;
    }
    
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
?>