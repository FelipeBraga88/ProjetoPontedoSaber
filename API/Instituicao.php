<?php

require_once "config.php";

    class Instituicao { //Criação dos métodos para manipulação do banco de dados
        public static function inserir( $dados ) {

            $tabela = "instituicao";
            $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

            $sql = "INSERT INTO $tabela (cnpj, razao_Inst, email_Inst, telefone_Inst, cep_Inst, endereco_Inst, num_end_Inst, cidade_Inst, estado_Inst, pais_Inst, senha_Inst, data_cad_Inst) VALUES (:cnpj, :razao_Inst, :email_Inst, :telefone_Inst, :cep_Inst, :endereco_Inst, :num_end_Inst, :cidade_Inst, :estado_Inst, :pais_Inst, :senha_Inst, :data_cad_Inst)";

            $stm = $conexao->prepare($sql);
            $stm->bindValue(":cnpj", $dados["cnpj"]);
            $stm->bindValue(":razao_Inst", $dados["razao_Inst"]);
            $stm->bindValue(":email_Inst", $dados["email_Inst"]);
            $stm->bindValue(":telefone_Inst", $dados["telefone_Inst"]);
            $stm->bindValue(":cep_Inst", $dados["cep_Inst"]);
            $stm->bindValue(":endereco_Inst", $dados["endereco_Inst"]);
            $stm->bindValue(":num_end_Inst", $dados["num_end_Inst"]);
            $stm->bindValue(":cidade_Inst", $dados["cidade_Inst"]);
            $stm->bindValue(":estado_Inst", $dados["estado_Inst"]);
            $stm->bindValue(":pais_Inst", $dados["pais_Inst"]);
            $stm->bindValue(":senha_Inst", $dados["senha_Inst"]);
            $stm->bindValue(":data_cad_Inst", $dados["data_cad_Inst"]);
            
            $stm->execute();

            if ( $stm->rowCount() > 0 ) {
                return [
                    'erro' => false,
                    'mensagem' => 'Instituicao registrada com sucesso!',
                    'dados' => []
                ];
            } else {
                return [
                    'erro' => true,
                    'mensagem' => 'Erro ao registrar Instituicao!',
                    'dados' => []
                ];
            }
        }

    public static function buscarInstituicaoPeloCnpj( $cnpj ) {

        $tabela = "instituicao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela WHERE cnpj = :cnpj";

        $stm = $conexao->prepare( $sql );
        $stm->bindValue(":cnpj", $cnpj);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetch(PDO::FETCH_ASSOC);        
            return [
                'erro' => false,
                'mensagem' => "Instituicao encontrada!",
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => "Instituicao nao cadastrada!",
                'dados' => []
            ];
        }
    }

    public static function buscarTodasInstituicoes() {

        $tabela = "instituicao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela";

        $stm = $conexao->prepare($sql);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetchAll(PDO::FETCH_ASSOC);
            return [
                'erro' => false,
                'mensagem' => 'Instituicoes encontradas!',
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Nao ha instituicoes cadastradas!',
                'dados' => []
            ];
        }
    }

    public static function alterar( $cnpj, $dados ) {
        $tabela = "instituicao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "UPDATE $tabela SET razao_Inst = :razao_Inst, email_Inst = :email_Inst, telefone_Inst = :telefone_Inst, cep_Inst = :cep_Inst, endereco_Inst = :endereco_Inst, num_end_Inst = :num_end_Inst, cidade_Inst = :cidade_Inst, estado_Inst = :estado_Inst, pais_Inst = :pais_Inst, senha_Inst = :senha_Inst, data_cad_Inst = :data_cad_Inst WHERE cnpj = :cnpj";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":razao_Inst", $dados["razao_Inst"]);
        $stm->bindValue(":email_Inst", $dados["email_Inst"]);
        $stm->bindValue(":telefone_Inst", $dados["telefone_Inst"]);
        $stm->bindValue(":cep_Inst", $dados["cep_Inst"]);
        $stm->bindValue(":endereco_Inst", $dados["endereco_Inst"]);
        $stm->bindValue(":num_end_Inst", $dados["num_end_Inst"]);
        $stm->bindValue(":cidade_Inst", $dados["cidade_Inst"]);
        $stm->bindValue(":estado_Inst", $dados["estado_Inst"]);
        $stm->bindValue(":pais_Inst", $dados["pais_Inst"]);
        $stm->bindValue(":senha_Inst", $dados["senha_Inst"]);
        $stm->bindValue(":data_cad_Inst", $dados["data_cad_Inst"]);
        $stm->bindValue(":cnpj", $cnpj);
        
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

    public static function deletar( $cnpj ) {
        $tabela = "instituicao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "DELETE FROM $tabela WHERE cnpj = :cnpj";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":cnpj", $cnpj);

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

    //Criar uma função para realizar o login
    public static function validarLogin( $email, $senha ) {
        $tabela = "instituicao";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela WHERE email_Inst = :email_Inst AND senha_Inst = :senha_Inst";

        $stm = $conexao->prepare( $sql );
        $stm->bindValue(":email_Inst", $email);
        $stm->bindValue(":senha_Inst", $senha);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetch(PDO::FETCH_ASSOC);        
            return [
                'erro' => false,
                'mensagem' => "Login realizado com sucesso!",
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => "Email ou senha incorretos!",
                'dados' => []
            ];
        }
    }
}

?>