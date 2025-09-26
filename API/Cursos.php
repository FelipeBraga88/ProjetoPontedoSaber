<?php

require_once "config.php";

    class Cursos { //Criação dos métodos para manipulação do banco de dados
        public static function inserir( $dados ) {

            $tabela = "curso";
            $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

            $sql = "INSERT INTO $tabela (id_Curso, nome_Curso, descricao, img, local_Curso, endereco_Curso, cep_Curso, num_end_Curso, cidade_Curso, estado_Curso, data_inicio, data_fim, status_inscricao, faixa_etaria, cnpj_Instituicao) VALUES (:id_Curso, :nome_Curso, :descricao, :img, :local_Curso, :endereco_Curso, :cep_Curso, :num_end_Curso, :cidade_Curso, :estado_Curso, :data_inicio, :data_fim, :status_inscricao, :faixa_etaria, :cnpj_Instituicao)";

            $stm = $conexao->prepare($sql);
            $stm->bindValue(":id_Curso", $dados["id_Curso"]);
            $stm->bindValue(":nome_Curso", $dados["nome_Curso"]);
            $stm->bindValue(":descricao", $dados["descricao"]);
            $stm->bindValue(":img", $dados["img"]);
            $stm->bindValue(":local_Curso", $dados["local_Curso"]);
            $stm->bindValue(":endereco_Curso", $dados["endereco_Curso"]);
            $stm->bindValue(":cep_Curso", $dados["cep_Curso"]);
            $stm->bindValue(":num_end_Curso", $dados["num_end_Curso"]);
            $stm->bindValue(":cidade_Curso", $dados["cidade_Curso"]);
            $stm->bindValue(":estado_Curso", $dados["estado_Curso"]);
            $stm->bindValue(":data_inicio", $dados["data_inicio"]);
            $stm->bindValue(":data_fim", $dados["data_fim"]);
            $stm->bindValue(":status_inscricao", $dados["status_inscricao"]);
            $stm->bindValue(":faixa_etaria", $dados["faixa_etaria"]);
            $stm->bindValue(":cnpj_Instituicao", $dados["cnpj_Instituicao"]);
            
            $stm->execute();

            if ( $stm->rowCount() > 0 ) {
                return [
                    'erro' => false,
                    'mensagem' => 'Curso registrado com sucesso!',
                    'dados' => []
                ];
            } else {
                return [
                    'erro' => true,
                    'mensagem' => 'Erro ao registrar curso!',
                    'dados' => []
                ];
            }
        }

    public static function buscarCursoPeloId( $idCurso ) {

        $tabela = "curso";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela WHERE id_Curso = :id_Curso";

        $stm = $conexao->prepare( $sql );
        $stm->bindValue(":id_Curso", $idCurso);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetch(PDO::FETCH_ASSOC);        
            return [
                'erro' => false,
                'mensagem' => "Curso encontrado!",
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => "Curso nao cadastrado!",
                'dados' => []
            ];
        }
    }

    public static function buscarTodosCursos() {

        $tabela = "curso";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela";

        $stm = $conexao->prepare($sql);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetchAll(PDO::FETCH_ASSOC);
            return [
                'erro' => false,
                'mensagem' => 'Cursos encontrados!',
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Nao ha cursos cadastrados!',
                'dados' => []
            ];
        }
    }

    public static function alterar( $idCurso, $dados ) {
        $tabela = "curso";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "UPDATE $tabela SET nome_Curso = :nome_Curso, descricao = :descricao, img = :img, local_Curso = :local_Curso, endereco_Curso = :endereco_Curso, cep_Curso = :cep_Curso, num_end_Curso = :num_end_Curso, cidade_Curso = :cidade_Curso, estado_Curso = :estado_Curso, data_inicio = :data_inicio, data_fim = :data_fim, status_inscricao = :status_inscricao, faixa_etaria = :faixa_etaria, cnpj_Instituicao = :cnpj_Instituicao WHERE id_Curso = :id_Curso";       

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":nome_Curso", $dados["nome_Curso"]);
        $stm->bindValue(":descricao", $dados["descricao"]);
        $stm->bindValue(":img", $dados["img"]);
        $stm->bindValue(":local_Curso", $dados["local_Curso"]);
        $stm->bindValue(":endereco_Curso", $dados["endereco_Curso"]);
        $stm->bindValue(":cep_Curso", $dados["cep_Curso"]);
        $stm->bindValue(":num_end_Curso", $dados["num_end_Curso"]);
        $stm->bindValue(":cidade_Curso", $dados["cidade_Curso"]);
        $stm->bindValue(":estado_Curso", $dados["estado_Curso"]);
        $stm->bindValue(":data_inicio", $dados["data_inicio"]);
        $stm->bindValue(":data_fim", $dados["data_fim"]);
        $stm->bindValue(":status_inscricao", $dados["status_inscricao"]);
        $stm->bindValue(":faixa_etaria", $dados["faixa_etaria"]);
        $stm->bindValue(":cnpj_Instituicao", $dados["cnpj_Instituicao"]);
        $stm->bindValue(":id_Curso", $idCurso);
        
        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            //return "Dados alterados com sucesso!";
            return [
                'erro' => false,
                'mensagem' => 'Dados alterados com sucesso!',
                'dados' => []
            ];
        } else {
            //return "Erro!";
            return [
                'erro' => true,
                'mensagem' => 'Erro ao alterar dados!',
                'dados' => []
            ];
        }
    }

    public static function deletar( $idCurso ) {
        $tabela = "curso";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "DELETE FROM $tabela WHERE id_Curso = :id_Curso";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":id_Curso", $idCurso);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            //return "Dados deletados com sucesso!";
            return [
                'erro' => false,
                'mensagem' => 'Dados deletados com sucesso!',
                'dados' => []
            ];
        } else {
            //return "Erro!";
            return [
                'erro' => true,
                'mensagem' => 'Erro ao deletar dados!',
                'dados' => []
            ];
        }
    }
}

?>