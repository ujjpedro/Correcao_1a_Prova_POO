<?php 
        include_once "../conf/default.inc.php";
        require_once "../conf/Conexao.php";

        class PessoaFisica {
            private $id;
            private $cpf;
            private $nome;
            private $nascimento;

            public function __construct($id, $cpf, $nome, $nascimento) {
                $this->setId($id);
                $this->setCpf($cpf);
                $this->setNome($nome);
                $this->setNascimento($nascimento);
            }

            public function setId($newId) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->id = $newId;
            // else 
                // throw new Exception("Número: ".$newNumero);
            }

            public function setCpf($newCpf) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->cpf = $newCpf;
            // else 
                // throw new Exception("Número: ".$newNumero);
            }

            public function setNome($newNome) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->nome = $newNome;
            // else 
                // throw new Exception("Número: ".$newNumero);
            }

            public function setNascimento($newNascimento) {
            // if ($newNumero > 0  && $newNumero <> "")
                return $this->nascimento = $newNascimento;
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

            public function getCpf() {
                if($this->cpf != "") {
                    return $this->cpf;
                } else {
                    return "Não informado";
                }
            }

            public function getNome() {
                if($this->nome != "") {
                    return $this->nome;
                } else {
                    return "Não informado";
                }
            }

            public function getNascimento() {
                if($this->nascimento != "") {
                    return $this->nascimento;
                } else {
                    return "Não informado";
                }
            }

            public function inserir(){
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare('INSERT INTO Pessoa_fisica (pf_cpf, pf_nome, pf_dt_nascimento) VALUES(:pf_cpf, :pf_nome, :pf_dt_nascimento)');
                $stmt->bindParam(':pf_cpf', $this->getCpf(), PDO::PARAM_STR);
                $stmt->bindParam(':pf_nome', $this->getNome(), PDO::PARAM_STR);
                $stmt->bindParam(':pf_dt_nascimento', $this->getNascimento(), PDO::PARAM_STR);
                return $stmt->execute();
            }

            public function atualizar() {
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare("UPDATE `prova`.`Pessoa_fisica` SET `pf_cpf` = :pf_cpf, `pf_nome` = :pf_nome, `pf_dt_nascimento` = :pf_dt_nascimento WHERE (`pf_id` = :pf_id);");
                $stmt->bindParam(':pf_id', $this->setId($this->id), PDO::PARAM_INT);
                $stmt->bindParam(':pf_cpf', $this->setCpf($this->cpf), PDO::PARAM_STR);
                $stmt->bindParam(':pf_nome', $this->setNome($this->nome), PDO::PARAM_STR);
                $stmt->bindParam(':pf_dt_nascimento', $this->setNascimento($this->nascimento), PDO::PARAM_STR);
                return $stmt->execute();
            }

            public function deletar() {
                $pdo = Conexao::getInstance();
                $stmt = $pdo->prepare("DELETE FROM `prova`.`Pessoa_fisica` WHERE pf_id = :pf_id");
                $stmt->bindParam(':pf_id', $this->setId($this->id), PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->execute();
            }
            
            public function buscarPessoa($id){
                require_once("../conf/Conexao.php");
                $conexao = Conexao::getInstance();
                $query = 'SELECT * FROM pessoa_fisica';
                if($id > 0){
                    $query .= ' WHERE pf_id = :id';
                    $stmt->bindParam(':id', $id);
                }
                    $stmt = $conexao->prepare($query);
                    if($stmt->execute())
                        return $stmt->fetchAll();
            
                    return false;
    
            }
        }
?>