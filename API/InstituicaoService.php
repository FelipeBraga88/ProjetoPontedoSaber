<?php

    include_once "Instituicao.php";

    class InstituicaoService { //Criação dos métodos GET, POST, PUT e DELETE

        public function get ($cnpj = null) {
            if ( $cnpj ) {            
                return Instituicao::buscarInstituicaoPeloCnpj( $cnpj ); //A consulta será feita pelo código da Instituição
            } else {              
                return Instituicao::buscarTodasInstituicoes(); //A consulta será de TODAS as instituições            
            }
        }

        public function post () {
            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para incluir");
            }
            return Instituicao::inserir( $dados );

        }

        public function put ( $cnpj = null ) {
           if ($cnpj == null) {
                throw new Exception("Falta o CNPJ");
            }

            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para alterar");
            }
            return Instituicao::alterar( $cnpj, $dados );

        }

        public function delete ( $cnpj = null ) {
            if ($cnpj == null) {
                throw new Exception("Falta o CNPJ");
            }
            return Instituicao::deletar( $cnpj );
        }

    }

?>