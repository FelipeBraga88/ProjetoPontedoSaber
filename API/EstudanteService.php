<?php

    include_once "Estudante.php";

    class EstudanteService { //Criação dos métodos GET, POST, PUT e DELETE

        public function get ($cpf = null) {
            if ( $cpf ) {            
                return Estudante::buscarEstudantePeloId( $cpf ); //A consulta será feita pelo código do curso            
            } else {              
                return Estudante::buscarTodosEstudantes(); //A consulta será de TODOS os cursos             
            }
        }

        public function post () {
            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para incluir");
            }
            return Estudante::inserir( $dados );

        }

        public function put ( $cpf = null ) {
           if ($cpf == null) {
                throw new Exception("Falta o CPF");
            }

            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para alterar");
            }
            return Estudante::alterar( $cpf, $dados );

        }

        public function delete ( $cpf = null ) {
            if ($cpf == null) {
                throw new Exception("Falta o CPF");
            }
            return Estudante::deletar( $cpf );
        }

    }

?>