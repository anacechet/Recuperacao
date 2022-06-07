<?php
    class Usuario{
        //Criando as variáveis como privadas.
        private $idUsuario;
        private $nome;
        private $login;
        private $senha;

        //Construindo as variáveis.
        public function __construct($idUsuario, $nome, $login, $senha){
            $this->setId($idUsuario);
            $this->setnome($nome);
            $this->setlogin($login);
            $this->setsenha($senha);
        }

        //Buscando e seta os valores das variáveis.
        public function getId(){ return $this->id; }
        public function setId($idUsuario){ $this->id = $idUsuario; }

        public function getnome(){ return $this->nome; }
        public function setnome($nome){ $this->nome = $nome; }

        public function getlogin(){ return $this->login; }
        public function setlogin($login){ $this->login = $login; }

        public function getsenha(){ return $this->senha; }
        public function setsenha($senha){ $this->senha = $senha; }
        

        public function insere() {
            //Chamando a conexão para poder inserir no banco de dados.
            require_once("conf/Conexao.php");
            //Criando conexão e chama o insert.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('INSERT INTO usuario (nome, login, senha) VALUES(:nome, :login, :senha)');
            //Chamando as variáveis através do get.
            $stmt->bindValue(':nome', $this->getnome());
            $stmt->bindValue(':login', $this->getlogin());
            $stmt->bindValue(':senha', $this->getsenha());
            //Executando o comando.
            return $stmt->execute();

        }

        function excluir(){
            //Criando conexão e chama o delete.
            $pdo = Conexao::getInstance();
            $stmt = $pdo ->prepare('DELETE FROM usuario WHERE idUsuario = :idUsuario');
            //Chamando a variável através do get.
            $stmt->bindValue(':idUsuario', $this->getId());
            //Executando o comando.
            return $stmt->execute();
        }

        public function editar(){
            //Chamando a conexão para poder editar no banco de dados.
            require_once("conf/Conexao.php");
            //Criando conexão e chama o update.
            $pdo = Conexao::getInstance();
            $stmt = $pdo->prepare('UPDATE usuario
            SET nome = :nome, login = :login, senha = :senha
            WHERE (idUsuario = :idUsuario);');
            //Chamando as variáveis através do get.
            $stmt->bindValue(':idUsuario', $this->getId());
            $stmt->bindValue(':nome', $this->getnome());
            $stmt->bindValue(':login', $this->getlogin());
            $stmt->bindValue(':senha', $this->getsenha());
            //Executando o comando.
            return $stmt->execute();
        }
        
        public function __toString(){
            return "[usuario]<br>ID:".$this->getId()."<br>".
                    "Nome:".$this->getnome()."<br>".
                    "Login:".$this->getlogin()."<br>".
                    "Senha:".$this->getsenha()."<br>";
        }
        
        public function listarUsuario($tipo = 0, $procurar = ""){
            //Criando conexão e seleciona as informações do usário.
            $pdo = Conexao::getInstance();
            $consulta = "SELECT * FROM usuario";
            if($tipo > 0)
                switch($tipo){
                    //se tipo da consulta for por id, mostra as informações de acordo com aquele id.
                    case(1): $consulta .= " WHERE idUsuario = :procurar"; break;
                    //se tipo da consulta for por nome, mostra as informações de acordo com aquele nome.
                    case(2): $consulta .= " WHERE nome LIKE :procurar"; $procurar .="%"; break;
                    //se tipo da consulta for por login, mostra as informações de acordo com aquele login.
                    case(3): $consulta .= " WHERE login LIKE :procurar "; $procurar = "%".$procurar; break;
                    //se tipo da consulta for por senha, mostra as informações de acordo com aquele senha.
                    case(4): $consulta .= " WHERE senha = :procurar "; break;
                }
           //Ordenando a consulta de acordo com o Id do Usuário.     
           $consulta .= " ORDER BY idUsuario ";
           //Preparando a consulta;
           $comando = $pdo->prepare($consulta);
           if($tipo > 0)
               $comando->bindValue(':procurar', $procurar);
            //Enviando a consulta.
           $comando->execute();
             return ($comando->fetchall(PDO::FETCH_ASSOC));
            
        }

        public function buscarUsuario($idUsuario){
            require_once("conf/Conexao.php");

            $conexao = Conexao::getInstance();

            $query = 'SELECT * FROM usuario';
            if($idUsuario > 0){
                $query .= ' WHERE idUsuario = :idUsuario';
                $stmt->bindParam(':idUsuario', $idUsuario);
            }
                $stmt = $conexao->prepare($query);
                if($stmt->execute())
                    return $stmt->fetchAll();
        
                return false;

        }

        public function efetuarLogin($login, $senha){
            $pdo = Conexao::getInstance();
            $sql = "SELECT nome FROM usuario WHERE login = '$login' AND senha = '$senha';";
            $resultado = $pdo->query($sql)->fetchAll();
            if($resultado){
                $_SESSION['nome'] = $resultado[0]['nome'];
                return true;
            } else {
                $_SESSION['nome'] = null;
                return false;
            }
        
        }


        }
    

?>