<?php

require_once "config.php";

    class Inscricao { //Criação dos métodos para manipulação do banco de dados
        public static function inserir( $dados ) {

            $tabela = "inscricao";
            $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

            $sql = "INSERT INTO $tabela (id_Inscricao, data_Inscricao, status_Inscricao, cpf_Estudante, id_Curso_Inscr) VALUES (:id_Inscricao, :data_Inscricao, :status_Inscricao, :cpf_Estudante, :id_Curso_Inscr)";

            $stm = $conexao->prepare($sql);
            $stm->bindValue(":id_Inscricao", $dados["id_Inscricao"]);
            $stm->bindValue(":data_Inscricao", $dados["data_Inscricao"]);
            $stm->bindValue(":status_Inscricao", $dados["status_Inscricao"]);
            $stm->bindValue(":cpf_Estudante", $dados["cpf_Estudante"]);
            $stm->bindValue(":id_Curso_Inscr", $dados["id_Curso_Inscr"]);

            $stm->execute();

            if ( $stm->rowCount() > 0 ) {
                return [
                    'erro' => false,
                    'mensagem' => 'Inscricao registrada com sucesso!',
                    'dados' => []
                ];
            } else {
                return [
                    'erro' => true,
                    'mensagem' => 'Erro ao registrar inscricao!',
                    'dados' => []
                ];
            }
        }

    public static function buscarInscricaoPeloId( $id_Inscricao ) {

        $tabela = "inscricao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela WHERE id_Inscricao = :id_Inscricao";

        $stm = $conexao->prepare( $sql );
        $stm->bindValue(":id_Inscricao", $id_Inscricao);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetch(PDO::FETCH_ASSOC);        
            return [
                'erro' => false,
                'mensagem' => "Inscricao encontrada!",
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => "Inscricao nao encontrada!",
                'dados' => []
            ];
        }
    }

    public static function buscarTodasInscricoes() {

        $tabela = "inscricao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela";

        $stm = $conexao->prepare($sql);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetchAll(PDO::FETCH_ASSOC);
            return [
                'erro' => false,
                'mensagem' => 'Incricoes encontradas!',
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Nao ha inscricoes cadastradas!',
                'dados' => []
            ];
        }
    }

    public static function alterar( $id_Inscricao, $dados ) {
        $tabela = "inscricao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "UPDATE $tabela SET data_Inscricao = :data_Inscricao, status_Inscricao = :status_Inscricao, cpf_Estudante = :cpf_Estudante, id_Curso_Inscr = :id_Curso_Inscr WHERE id_Inscricao = :id_Inscricao";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":data_Inscricao", $dados["data_Inscricao"]);
        $stm->bindValue(":status_Inscricao", $dados["status_Inscricao"]);
        $stm->bindValue(":cpf_Estudante", $dados["cpf_Estudante"]);
        $stm->bindValue(":id_Curso_Inscr", $dados["id_Curso_Inscr"]);
        $stm->bindValue(":id_Inscricao", $id_Inscricao);
        
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

    public static function deletar( $id_Inscricao ) {
        $tabela = "inscricao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "DELETE FROM $tabela WHERE id_Inscricao = :id_Inscricao";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":id_Inscricao", $id_Inscricao);

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