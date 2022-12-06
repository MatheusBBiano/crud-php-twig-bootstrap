<?php

    class CadastroController{

    public function index(){

            try{
                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('novousuario.html');
                                        

                $conteudo = $template->render();
                echo $conteudo;
                
                


            

            }catch(Exception $e){
                echo $e->getMessage();
            }
        

            //echo 'Home';
        }

        public function create(){
            try{
                Usuario::insert($_POST);
                echo '<script>alert("Cadastro efetuado com sucesso!");</script>';
                echo '<script>location.href="http://localhost/crud/?pagina=usuario"</script>';
            } catch(Exception $e){
                echo '<script>alert("' . $e->getMessage() . '");</script>';
                echo '<script>location.href="http://localhost/crud/?pagina=cadastro"</script>';

            }
           

        }

        public function change($paramId){
            try{
                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('update.html');

                $usuario = Usuario::SelecionaID($paramId);
                $parametros = array();
                $parametros['id'] = $usuario->id;
                $parametros['nome'] = $usuario->nome;
                $parametros['email'] = $usuario->email;
                $parametros['data_nasc'] = $usuario->data_nasc;
                                        

                $conteudo = $template->render($parametros);
                echo $conteudo;
                
                     

            }catch(Exception $e){
                echo $e->getMessage();
            }


        }

        public function update(){
            
            try{
                Usuario::update($_POST);
                echo '<script>alert("Alteração efetuado com sucesso!");</script>';
                echo '<script>location.href="http://localhost/crud/?pagina=usuario"</script>';
            } catch(Exception $e){
                echo '<script>alert("' . $e->getMessage() . '");</script>';
                echo '<script>location.href="http://localhost/crud/?pagina=cadastro&metodo=change&id='.$_POST['id'].'"</script>';

            }

        }

        public function delete(){
            try{
                Usuario::delete($_GET);
                echo '<script>alert("Usuario Excluido com Sucesso!");</script>';
                echo '<script>location.href="http://localhost/crud/?pagina=usuario"</script>';
            } catch(Exception $e){
                echo '<script>alert("' . $e->getMessage() . '");</script>';
                echo '<script>location.href="http://localhost/crud/?pagina=cadastro"</script>';

            }

        }


        
    }