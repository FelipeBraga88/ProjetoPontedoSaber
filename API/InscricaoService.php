<?php

    include_once "Inscricao.php";

    class InscricaoService { //Criação dos métodos GET, POST, PUT e DELETE

        public function get ($id_Inscricao = null) {
            if ( $id_Inscricao ) {
                return Inscricao::buscarInscricaoPeloId( $id_Inscricao ); //A consulta será feita pelo código da inscrição      
            } else {
                return Inscricao::buscarTodasInscricoes(); //A consulta será de TODOS as inscrições
            }
        }

        public function post () {
            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para incluir");
            }
            
            // Função nova para verificar se o estudante já está inscrito neste curso
            $verificacao = Inscricao::verificarInscrito($dados['cpf_Estudante'], $dados['id_Curso_Inscr']);
            if (!$verificacao['erro']) {
                // Se erro = false, significa que já existe inscrição
                return [
                    'erro' => true,
                    'mensagem' => 'Você já está inscrito neste curso!',
                    'dados' => []
                ];
            }
            return Inscricao::inserir( $dados );
        }

        public function put ( $id_Inscricao = null ) {
           if ($id_Inscricao == null) {
                throw new Exception("Falta o ID da Inscrição");
            }

            //Pegar os dados no formato JSON para gravar no banco de dados
            $dados = json_decode(file_get_contents("php://input"), true, 512);
            if ($dados == null) {
                throw new Exception("Falta os dados para alterar");
            }
            return Inscricao::alterar( $id_Inscricao, $dados );

        }

        public function delete ( $id_Inscricao = null ) {
            if ($id_Inscricao == null) {
                throw new Exception("Falta o ID da Inscrição");
            }
            return Inscricao::deletar( $id_Inscricao );
        }

        //Função nova criada para verificar se o estudante ja está inscrito em determinado curso!
        public function verificar($cpf, $idCurso) {
            return Inscricao::verificarInscrito($cpf, $idCurso);
        }
    }

?>