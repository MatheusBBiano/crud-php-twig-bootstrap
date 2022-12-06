<?php

    class Usuario{
        public static function selecionaTodos()
        {

            $con = Connection::getConn();
            $sql = "SELECT * FROM usuarios";
            $sql = $con->prepare($sql);
            $sql->execute();

            //var_dump($sql->fetchAll());
            $res = null;
            while ($row = $sql->fetchObject('usuario')) {

                $res[] = $row;
            }

            if (!$res) {
                throw new Exception("Não foi encontrado nenhum registro!");
            }


            return $res;

        }

        public static function SelecionaID($idPost){

            $con = Connection::getConn();
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
            $sql->execute();

            //var_dump($sql->fetchAll());

            $res = $sql->fetchObject('Usuario');

            if (!$res) {
                throw new Exception("Não foi encontrado nenhum registro!");
            }


            return $res;

        }

        public static function insert($dadosPOST){
            $con = Connection::getConn();
            $sql = 'INSERT INTO usuarios (nome, email, senha, data_nasc) VALUES (:nome, :email, :senha, :data_nasc)';
            $sql = $con->prepare($sql);
            $sql->bindValue(":nome", $dadosPOST['nome']);
            $sql->bindValue(":email", $dadosPOST['email']);
            $sql->bindValue(":senha", md5($dadosPOST['senha']));
            $sql->bindValue(":data_nasc", $dadosPOST['data_nasc']);
            $res = $sql->execute();

            if($res == 0){
                throw new Exception("Não foi possivel cadastrar o usuario");
            
            }

            return true;
        }

        public static function update($dadosPOST){
            $con = Connection::getConn();
            $sql = 'UPDATE usuarios  SET nome= :nome, email= :email, data_nasc=:data_nasc WHERE id= :id';
            $sql = $con->prepare($sql);
            $sql->bindValue(":nome", $dadosPOST['nome']);
            $sql->bindValue(":email", $dadosPOST['email']);
            $sql->bindValue(":id", $dadosPOST['id']);
            $sql->bindValue(":data_nasc", $dadosPOST['data_nasc']);
            $res = $sql->execute();
            

            if($res == 0){
                throw new Exception("Não foi possivel alterar o usuario");
                
            }
            return true;

        }

        public static function delete($dadosGET){
            $con = Connection::getConn();
            $sql = 'DELETE FROM usuarios WHERE id = :id';
            $sql = $con->prepare($sql);
            $sql->bindValue(":id", $dadosGET['id']);
            $res = $sql->execute();
            if($res == 0){
                throw new Exception("Não foi possivel deletar o usuario");
                
            }
            return true;
            

        }


    
    }