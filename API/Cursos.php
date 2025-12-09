<?php

require_once "config.php";

    class Cursos { //Criação dos métodos para manipulação do banco de dados
        public static function inserir( $dados ) {

            $tabela = "curso";
            $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

            $sql = "INSERT INTO $tabela (nome_Curso, descricao, categoria_Curso, modalidade_Curso, img, link_Sala, endereco_Curso, data_inicio, hora_inicio, duracao_Curso, vagas_Curso, status_inscricao, cnpj_Instituicao) VALUES (:nome_Curso, :descricao, :categoria_Curso, :modalidade_Curso, :img, :link_Sala, :endereco_Curso, :data_inicio, :hora_inicio, :duracao_Curso, :vagas_Curso, :status_inscricao, :cnpj_Instituicao)";

            $stm = $conexao->prepare($sql);
            $stm->bindValue(":nome_Curso", $dados["nome_Curso"]);
            $stm->bindValue(":descricao", $dados["descricao"]);
            $stm->bindValue(":categoria_Curso", $dados["categoria_Curso"]);
            $stm->bindValue(":modalidade_Curso", $dados["modalidade_Curso"]);
            $stm->bindValue(":img", $dados["img"]);
            $stm->bindValue(":link_Sala", $dados["link_Sala"]);
            $stm->bindValue(":endereco_Curso", $dados["endereco_Curso"]);
            $stm->bindValue(":data_inicio", $dados["data_inicio"]);
            $stm->bindValue(":hora_inicio", $dados["hora_inicio"]);
            $stm->bindValue(":duracao_Curso", $dados["duracao_Curso"]);
            $stm->bindValue(":vagas_Curso", $dados["vagas_Curso"]);
            $stm->bindValue(":status_inscricao", $dados["status_inscricao"]);
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

        $sql = "UPDATE $tabela SET nome_Curso = :nome_Curso, descricao = :descricao,  categoria_Curso = :categoria_Curso, modalidade_Curso = :modalidade_Curso, img = :img, link_Sala = :link_Sala, endereco_Curso = :endereco_Curso, data_inicio = :data_inicio, hora_inicio = :hora_inicio, duracao_Curso = :duracao_Curso, vagas_Curso = :vagas_Curso, status_inscricao = :status_inscricao, cnpj_Instituicao = :cnpj_Instituicao WHERE id_Curso = :id_Curso";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":nome_Curso", $dados["nome_Curso"]);
        $stm->bindValue(":descricao", $dados["descricao"]);
        $stm->bindValue(":categoria_Curso", $dados["categoria_Curso"]);
        $stm->bindValue(":modalidade_Curso", $dados["modalidade_Curso"]);
        $stm->bindValue(":img", $dados["img"]);
        $stm->bindValue(":link_Sala", $dados["link_Sala"]);
        $stm->bindValue(":endereco_Curso", $dados["endereco_Curso"]);
        $stm->bindValue(":data_inicio", $dados["data_inicio"]);
        $stm->bindValue(":hora_inicio", $dados["hora_inicio"]);
        $stm->bindValue(":duracao_Curso", $dados["duracao_Curso"]);
        $stm->bindValue(":vagas_Curso", $dados["vagas_Curso"]);
        $stm->bindValue(":status_inscricao", $dados["status_inscricao"]);
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