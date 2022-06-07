<?php
    class Tabuleiro{
        //Criando as variáveis como privadas.
        private $idTabuleiro;
        private $LadoTabuleiro;

        //Construindo as variáveis.
        public function __construct($idTabuleiro, $LadoTabuleiro){
            $this->setId($idTabuleiro);
            $this->setLadoTabuleiro($LadoTabuleiro);
        }

        //Buscando e seta os valores das variáveis.
        public function getId(){ return $this->id; }
        public function setId($idTabuleiro){ $this->id = $idTabuleiro; }

        public function getLadoTabuleiro(){ return $this->LadoTabuleiro; }
        public function setLadoTabuleiro($LadoTabuleiro){ $this->LadoTabuleiro = $LadoTabuleiro; }
        
        public function area(){
            return $this->LadoTabuleiro * $this->LadoTabuleiro;
        }
        public function perimetro(){
            return $this->LadoTabuleiro * 4;
        }

        public function insere() {

            //Chamando a conexão para poder inserir no banco de dados.
            require_once("conf/Conexao.php");
            //Criando conexão e chama o insert.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO tabuleiro (LadoTabuleiro) VALUES(:LadoTabuleiro)');
            //Chamando as variáveis através do get.
            $stmt->bindValue(':LadoTabuleiro', $this->getLadoTabuleiro());
            //Executando o comando.
            return $stmt->execute();

        }

        function excluir($idTabuleiro){
            //Criando conexão e chama o delete.
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM tabuleiro WHERE idTabuleiro = :idTabuleiro');
            //Chamando a variável através do get.
            $stmt->bindValue(':idTabuleiro', $idTabuleiro);
            //Executando o comando.
            return $stmt->execute();
        }

        public function editar(){
             //Chamando a conexão para poder editar no banco de dados.
            require_once("conf/Conexao.php");
            //Criando conexão e chama o update.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE tabuleiro
            SET LadoTabuleiro = :LadoTabuleiro
            WHERE (idTabuleiro = :idTabuleiro);');
            //Chamando as variáveis através do get.
            $stmt->bindValue(':idTabuleiro', $this->getId());
            $stmt->bindValue(':LadoTabuleiro', $this->getLadoTabuleiro());
            //Executando o comando.
            return $stmt->execute();
        }
        
        public function __toString(){
            return "[Tabuleiro]<br>ID:".$this->getId()."<br>".
                    "Lado Tabuleiro:".$this->getLadoTabuleiro()."<br>".
                    "Área:".$this->area()."<br>".
                    "Perimetro:".$this->perimetro()."<br>";
        }
        
        public function listarTabuleiro($tipo = 0, $procurar = ""){
            //Criando conexão e seleciona as informações do Tabuleiro.
            $pdo = Conexao::getInstance();
            $consulta = "SELECT * FROM tabuleiro";
            if($tipo > 0)
                switch($tipo){
                    case(1): $consulta .= " WHERE idTabuleiro like :procurar"; $procurar = "%".$procurar."%"; break;
                    //se tipo da consulta for por id, mostra as informações de acordo com aquele id.
                    case(2): $consulta .= " WHERE LadoTabuleiro LIKE :procurar"; $procurar .="%"; break;
                     //se tipo da consulta for por lado, mostra as informações de acordo com aquele lado.
                }
              
            //Ordenando a consulta de acordo com o Id do Tabuleiro.          
            $consulta .= " ORDER BY idTabuleiro ";
           //Preparando a consulta
           $comando = $pdo->prepare($consulta);
           if($tipo > 0)
               $comando->bindValue(':procurar', $procurar);
          //Enviando a consulta.
           $comando->execute();
             return ($comando->fetchall(PDO::FETCH_ASSOC));
            
        }

        public function buscarTabuleiro($idTabuleiro){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM tabuleiro';
            if($idTabuleiro > 0){
                $query .= ' WHERE idTabuleiro = :idTabuleiro';
                $stmt->bindParam(':idTabuleiro', $idTabuleiro);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        function desenha(){
            $str = "<div style='height: ".$this->getLadoTabuleiro()."vw; width: ".$this->getLadoTabuleiro()."vw; background-color: #000000;'></div>";
            return $str;
        }
    }

?>