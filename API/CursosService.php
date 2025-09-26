<?php

    include_once "Cursos.php";

    class AlunosService { //Criação dos métodos GET, POST, PUT e DELETE

        public function get ($idCurso = null) {
            if ( $idCurso ) {            
                return Cursos::buscarCursoPeloId( $idCurso ); //A consulta será feita pelo código do curso            
            } else {              
                return Cursos::buscarTodosCursos(); //A consulta será de TODOS os cursos             
            }
        }

        public function post () {
            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para incluir");
            }
            return Cursos::inserir( $dados );

        }

        public function put ( $idCurso = null ) {
           if ($idCurso == null) {
                throw new Exception("Falta o código");
            }

            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para alterar");
            }
            return Cursos::alterar( $idCurso, $dados );

        }

        public function delete ( $idCurso = null ) {
            if ($idCurso == null) {
                throw new Exception("Falta o código");
            }
            return Cursos::deletar( $id );
        }

    }

?>