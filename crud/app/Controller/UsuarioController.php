<?php
    class UsuarioController{

        public function index(){
        
            try{
                $users = Usuario::selecionaTodos();
                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('listarusuarios.html');

                $parametros = array();
                $parametros["usuarios"] = $users;
                

                $conteudo = $template->render($parametros);
                echo $conteudo;
                
                


                //var_dump($users);

            }catch(Exception $e){
                echo $e->getMessage();
            }

            

            //echo 'Home';
        }
    }