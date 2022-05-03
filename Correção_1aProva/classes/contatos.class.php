<?php 
        include_once "../conf/default.inc.php";
        require_once "../conf/Conexao.php";


        class Contatos {
            private $id;
            private $tipo;
            private $descricao;
            private $pf_id;

            public function __construct($id, $tipo, $descricao, $pf_id) {
                $this->setId($id);
                $this->setTipo($tipo);
                $this->setDescricao($descricao);
                $this->setPfId($pf_id);
            }

            public function setId($newId) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->id = $newId;
            // else 
                // throw new Exception("Número: ".$newNumero);
            }

            public function setTipo($newTipo) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->tipo = $newTipo;
            // else 
                // throw new Exception("Número: ".$newNumero);
            }
            
            public function setDescricao($newDescricao) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->descricao = $newDescricao;
            // else 
                // throw new Exception("Número: ".$newNumero);
            }

            public function setPfId($pf_id) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->pf_id = $pf_id;
            // else 
                // throw new Exception("Número: ".$newNumero);
            }

            public function getId() {
                if($this->id != "") {
                    return $this->id;
                } else {
                    return "Não informado";
                }
            }

            public function getTipo() {
                if($this->tipo != "") {
                    return $this->tipo;
                } else {
                    return "Não informado";
                }
            }

            public function getDescricao() {
                if($this->descricao != "") {
                    return $this->descricao;
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


            public function inserir() {
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('INSERT INTO Contatos (cont_tipo, cont_descricao, cont_pf_id) VALUES(:cont_tipo, :cont_descricao, :cont_pf_id)');
                $stmt->bindParam(':cont_tipo', $this->getTipo(), PDO::PARAM_STR);
                $stmt->bindParam(':cont_descricao', $this->getDescricao(), PDO::PARAM_STR);
                $stmt->bindParam(':cont_pf_id', $this->getPfId(), PDO::PARAM_STR);
                return $stmt->execute();
            }

            public function atualizar() {
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare("UPDATE `prova`.`Contatos` SET `cont_tipo` = :cont_tipo, `cont_descricao` = :cont_descricao, `cont_pf_id` = :cont_pf_id  WHERE (`cont_id` = :cont_id);");
                $stmt->bindParam(':cont_id', $this->setId($this->id), PDO::PARAM_INT);
                $stmt->bindParam(':cont_tipo', $this->setTipo($this->tipo), PDO::PARAM_STR);
                $stmt->bindParam(':cont_descricao', $this->setDescricao($this->descricao), PDO::PARAM_STR);
                $stmt->bindParam(':cont_pf_id', $this->setPfId($this->pf_id), PDO::PARAM_STR);
                return $stmt->execute();
            }

            public function deletar() {
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare("DELETE FROM `prova`.`Contatos` WHERE cont_id = :cont_id");
                $stmt->bindParam(':cont_id', $this->setId($this->id), PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->execute();
            }
        }
?>