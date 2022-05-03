<?php 
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";

    class ContaCorrente {
        private $numero;
        private $saldo;
        private $pf_id;
        private $ultalter;

        public function __construct($numero, $saldo, $pf_id, $ultalter) {
            $this->setNumero($numero);
            $this->setSaldo($saldo);
            $this->setPfId($pf_id);
            $this->setUltalter($ultalter);
        }

        public function setNumero($newNumero) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->numero = $newNumero;
            // else 
                // throw new Exception("Número: ".$newNumero);
        }

        public function setSaldo($newSaldo) {
            // if ($newSaldo > 0  && $newSaldo <> "")
                return $this->saldo = $newSaldo;
            // else 
                // throw new Exception("Número do ID: ".$newSaldo);
        }

        public function setPfId($pf_id) {
            // if ($pf_id > 0  && $pf_id <> "")
                return $this->pf_id = $pf_id;
            // else 
                // throw new Exception("ID Pessoa Física: ".$pf_id);
        }
            
        public function setUltalter($newUltalter) {
            // if ($newUltalter > 0  && $newUltalter <> "")
                return $this->ultalter = $newUltalter;
            // else 
                // throw new Exception("Última alteração: ".$newUltalter);
        }

        public function getNumero() {
            if($this->numero != "") {
                return $this->numero;
            } else {
                return "Não informado";
            }
        }

        public function getSaldo() {
            if($this->saldo != "") {
                return $this->saldo;
            } else {
                return "Não informado";
            }
        }

        public function getPfId() {
            if($this->pf_id != "") {
                return $this->pf_id;
            } else {
                return "Não informado";
            }
        }

        public function getUltalter() {
            if($this->ultalter != "") {
                return $this->ultalter;
            } else {
                return "Não informado";
            }
        }


        public function inserir() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO Conta_corrente (cc_saldo, cc_pf_id, cc_dt_ultima_alteracao) VALUES(:cc_saldo, :cc_pf_id, :cc_dt_ultima_alteracao)');
            $stmt->bindParam(':cc_saldo', $this->getSaldo(), PDO::PARAM_STR);
            $stmt->bindParam(':cc_pf_id', $this->getPfId(), PDO::PARAM_STR);
            $stmt->bindParam(':cc_dt_ultima_alteracao', $this->getUltalter(), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function atualizar() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("UPDATE `prova`.`Conta_corrente` SET `cc_saldo` = :cc_saldo, `cc_pf_id` = :cc_pf_id, `cc_dt_ultima_alteracao` = :cc_dt_ultima_alteracao WHERE (`cc_numero` = :cc_numero);");
            $stmt->bindParam(':cc_numero', $this->setNumero($this->numero), PDO::PARAM_INT);
            $stmt->bindParam(':cc_saldo', $this->setSaldo($this->saldo), PDO::PARAM_STR);
            $stmt->bindParam(':cc_pf_id', $this->setPfId($this->pf_id), PDO::PARAM_STR);
            $stmt->bindParam(':cc_dt_ultima_alteracao', $this->setUltalter($this->ultalter), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function deletar() {
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare("DELETE FROM `prova`.`Conta_corrente` WHERE cc_numero = :cc_numero");
            $stmt->bindParam(':cc_numero', $this->setNumero($this->numero), PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->execute();
        }
           
        public function buscarConta($id){
            require_once("../conf/Conexao.php");
            $conexao = Conexao::getInstance();
            $query = 'SELECT * FROM conta_corrente';
            if($id > 0){
                $query .= ' WHERE cc_numero = :cc_numero';
                $stmt->bindParam(':cc_numero', $id);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        public function saque($valor){
            $pdo = Conexao::getInstance();
            $cc_saldo = floatval ($this->setSaldo($this->saldo)) - floatval($valor);
            $stmt = $pdo->prepare("UPDATE `prova`.`Conta_corrente` SET `cc_saldo` = $cc_saldo, `cc_pf_id` = :cc_pf_id, `cc_dt_ultima_alteracao` = :cc_dt_ultima_alteracao WHERE (`cc_numero` = :cc_numero);");
            $stmt->bindValue(':cc_numero', $this->setNumero($this->numero), PDO::PARAM_INT);
            $stmt->bindValue(':cc_pf_id', $this->setPfId($this->pf_id), PDO::PARAM_STR);
            $stmt->bindValue(':cc_dt_ultima_alteracao', date("Y-m-d"), PDO::PARAM_STR);
            return $stmt->execute();
        }

        public function deposito($valor){
            $pdo = Conexao::getInstance();
            $cc_saldo = floatval ($this->setSaldo($this->saldo)) + floatval($valor);
            $stmt = $pdo->prepare("UPDATE `prova`.`Conta_corrente` SET `cc_saldo` = $cc_saldo, `cc_pf_id` = :cc_pf_id, `cc_dt_ultima_alteracao` = :cc_dt_ultima_alteracao WHERE (`cc_numero` = :cc_numero);");
            $stmt->bindValue(':cc_numero', $this->setNumero($this->numero), PDO::PARAM_INT);
            $stmt->bindValue(':cc_pf_id', $this->setPfId($this->pf_id), PDO::PARAM_STR);
            $stmt->bindValue(':cc_dt_ultima_alteracao', date("Y-m-d"), PDO::PARAM_STR);
            return $stmt->execute();
        }
    }
?>