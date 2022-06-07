<?php
    class Quadrado{
        //Criação das variáveis de forma privada.
        private $idQuadrado;
        private $lado;
        private $cor;
        private $tabuleiro_idTabuleiro;

        //Construção das variáveis a partir de uma função chamada construct.
        public function __construct($idQuadrado, $lado, $cor, $tabuleiro_idTabuleiro){
            $this->setId($idQuadrado);
            $this->setlado($lado);
            $this->setcor($cor);
            $this->settabuleiro_idTabuleiro($tabuleiro_idTabuleiro);
        }

        //Busca dos valores das variáveis com o get e os seta com o set.
        public function getId(){ return $this->id; }
        public function setId($idQuadrado){ $this->id = $idQuadrado; }

        public function getlado(){ return $this->lado; }
        public function setlado($lado){ $this->lado = $lado; }

        public function getcor(){ return $this->cor; }
        public function setcor($cor){ $this->cor = $cor; }

        public function gettabuleiro_idTabuleiro(){ return $this->tabuleiro_idTabuleiro; }
        public function settabuleiro_idTabuleiro($tabuleiro_idTabuleiro){ $this->tabuleiro_idTabuleiro = $tabuleiro_idTabuleiro; }
        

        public function insere() {
            //Chamando a conexão.
            require_once("conf/Conexao.php");
            //Criando conexão e chama o método insert.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO quadrado (lado, cor, tabuleiro_idTabuleiro) VALUES(:lado, :cor, :tabuleiro_idTabuleiro)');
            //Buscando os valores das variáveis através do get.
            $stmt->bindValue(':lado', $this->getlado());
            $stmt->bindValue(':cor', $this->getcor());
            $stmt->bindValue(':tabuleiro_idTabuleiro', $this->gettabuleiro_idTabuleiro());
            //Executando o comando e insere os valores no banco de dados.
            return $stmt->execute();

        }

        function excluir(){
            //Estabelecendo a conexão e chama o delete.
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM quadrado WHERE idQuadrado = :idQuadrado');
            //Buscando o valor da variável através do get.
            $stmt->bindValue(':idQuadrado', $this->getId());
            //Executando o comando e exclui as informações do banco de dados.
            return $stmt->execute();
        }

        public function editar(){
            //Chama a conexão para efetuar as mudanças no banco.
            require_once("conf/Conexao.php");
            //Estabelecendo a conexão e chama o update.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE quadrado
            SET lado = :lado, cor = :cor, tabuleiro_idTabuleiro = :tabuleiro_idTabuleiro
            WHERE (idQuadrado = :idQuadrado);');
            //Buscando os valores das variáveis através do get.
            $stmt->bindValue(':idQuadrado', $this->getId());
            $stmt->bindValue(':lado', $this->getlado());
            $stmt->bindValue(':cor', $this->getcor());
            $stmt->bindValue(':tabuleiro_idTabuleiro', $this->gettabuleiro_idTabuleiro());
            //Executando o comando.
            return $stmt->execute();
        }
        
        public function __toString(){
            return "[quadrado]<br>ID:".$this->getId()."<br>".
                    "lado:".$this->getlado()."<br>".
                    "cor:".$this->getcor()."<br>".
                    "idTabuleiro:".$this->gettabuleiro_idTabuleiro()."<br>";
        }
        
        public function listarQuadrado($tipo = 0, $procurar = ""){
            //Estabelecendo a conexão e seleciona as informações do usário.
            $pdo = Conexao::getInstance();
            $consulta = "SELECT * FROM quadrado";
            if($tipo > 0)
                switch($tipo){
                    //caso o tipo da consulta for id lista de acordo com id.
                    case(1): $consulta .= " WHERE idQuadrado = :procurar"; break;
                    //se tipo da consulta for lado lista de acordo com lado.
                    case(2): $consulta .= " WHERE lado LIKE :procurar"; $procurar .="%"; break;
                    //se tipo da consulta for cor lista de acordo com cor.
                    case(3): $consulta .= " WHERE cor LIKE :procurar "; $procurar = "%".$procurar; break;
                    //se tipo da consulta for tabuleiro_idTabuleiro lista de acordo com aquele tabuleiro_idTabuleiro.
                    case(4): $consulta .= " WHERE tabuleiro_idTabuleiro = :procurar "; break;
                }
               
           //Ordenando a consulta de acordo com o id do quadrado.     
           $consulta .= " ORDER BY idQuadrado ";
           //Preparando a consulta;
           $comando = $pdo->prepare($consulta);
           if($tipo > 0)
               $comando->bindValue(':procurar', $procurar);
            //Enviando a consulta.
           $comando->execute();
             return ($comando->fetchall(PDO::FETCH_ASSOC));
            
        }

        public function buscarquadrado($idQuadrado){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM quadrado';
            if($idQuadrado > 0){
                $query .= ' WHERE idQuadrado = :idQuadrado';
                $stmt->bindParam(':idQuadrado', $idQuadrado);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }
    
            function desenha(){
                $str = "<div style='width: ".$this->getLado()."px; height: ".$this->getLado()."px; background: ".$this->getCor()."'></div>";
            
                return $str;
            }
                

        }
    

?>