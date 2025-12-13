<?php

require_once "config.php";

class Estudante { //Criação dos métodos para manipulação do banco de dados
    public static function inserir( $dados ) {

        $tabela = "estudante";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "INSERT INTO $tabela (cpf, nome_Estd, idade_Estd, email_Estd, telefone_Estd, cep_Estd, endereco_Estd, num_end_Estd, cidade_Estd, estado_Estd, pais_Estd, senha_Estd, data_cad_Estd) VALUES (:cpf, :nome_Estd, :idade_Estd, :email_Estd, :telefone_Estd, :cep_Estd, :endereco_Estd, :num_end_Estd, :cidade_Estd, :estado_Estd, :pais_Estd, :senha_Estd, :data_cad_Estd)";

        $stm = $conexao->prepare($sql);
        $stm->bindValue(":cpf", $dados["cpf"]);
        $stm->bindValue(":nome_Estd", $dados["nome_Estd"]);
        $stm->bindValue(":idade_Estd", $dados["idade_Estd"]);
        $stm->bindValue(":email_Estd", $dados["email_Estd"]);
        $stm->bindValue(":telefone_Estd", $dados["telefone_Estd"]);
        $stm->bindValue(":cep_Estd", $dados["cep_Estd"]);
        $stm->bindValue(":endereco_Estd", $dados["endereco_Estd"]);
        $stm->bindValue(":num_end_Estd", $dados["num_end_Estd"]);
        $stm->bindValue(":cidade_Estd", $dados["cidade_Estd"]);
        $stm->bindValue(":estado_Estd", $dados["estado_Estd"]);
        $stm->bindValue(":pais_Estd", $dados["pais_Estd"]);
        $stm->bindValue(":senha_Estd", $dados["senha_Estd"]);
        $stm->bindValue(":data_cad_Estd", $dados["data_cad_Estd"]);
        
        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            return [
                'erro' => false,
                'mensagem' => 'Estudante registrado com sucesso!',
                'dados' => []
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Erro ao registrar estudante!',
                'dados' => []
            ];
        }
    }

    public static function buscarEstudantePeloCpf( $cpf ) {

        $tabela = "estudante";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela WHERE cpf = :cpf";

        $stm = $conexao->prepare( $sql );
        $stm->bindValue(":cpf", $cpf);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetch(PDO::FETCH_ASSOC);        
            return [
                'erro' => false,
                'mensagem' => "Estudante encontrado!",
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => "Estudante não cadastrado!",
                'dados' => []
            ];
        }
    }

    public static function buscarTodosEstudantes() {

        $tabela = "estudante";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela";

        $stm = $conexao->prepare($sql);

        $stm->execute();

        if ( $stm->rowCount() > 0 ) {
            $valores = $stm->fetchAll(PDO::FETCH_ASSOC);
            return [
                'erro' => false,
                'mensagem' => 'Estudantes encontrados!',
                'dados' => $valores
            ];
        } else {
            return [
                'erro' => true,
                'mensagem' => 'Nao ha estudantes cadastrados!',
                'dados' => []
            ];
        }
    }

    public static function alterar( $cpf, $dados ) {
        $tabela = "estudante";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "UPDATE $tabela SET nome_Estd = :nome_Estd, idade_Estd = :idade_Estd, email_Estd = :email_Estd, telefone_Estd = :telefone_Estd, /*cep_Estd = :cep_Estd,*/ endereco_Estd = :endereco_Estd, num_end_Estd = :num_end_Estd, cidade_Estd = :cidade_Estd, estado_Estd = :estado_Estd, pais_Estd = :pais_Estd, senha_Estd = :senha_Estd/*, data_cad_Estd = :data_cad_Estd*/ WHERE cpf = :cpf";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":nome_Estd", $dados["nome_Estd"]);
        $stm->bindValue(":idade_Estd", $dados["idade_Estd"]);
        $stm->bindValue(":email_Estd", $dados["email_Estd"]);
        $stm->bindValue(":telefone_Estd", $dados["telefone_Estd"]);
        //$stm->bindValue(":cep_Estd", $dados["cep_Estd"]);
        $stm->bindValue(":endereco_Estd", $dados["endereco_Estd"]);
        $stm->bindValue(":num_end_Estd", $dados["num_end_Estd"]);
        $stm->bindValue(":cidade_Estd", $dados["cidade_Estd"]);
        $stm->bindValue(":estado_Estd", $dados["estado_Estd"]);
        $stm->bindValue(":pais_Estd", $dados["pais_Estd"]);
        $stm->bindValue(":senha_Estd", $dados["senha_Estd"]);
        //$stm->bindValue(":data_cad_Estd", $dados["data_cad_Estd"]);
        $stm->bindValue(":cpf", $cpf);
        
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

    public static function deletar( $cpf ) {
        $tabela = "estudante";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "DELETE FROM $tabela WHERE cpf = :cpf";

        //Trocar o apelido pela informação
        $stm = $conexao->prepare($sql);
        $stm->bindValue(":cpf", $cpf);

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
        $tabela = "estudante";
        $conexao = new PDO( dbDrive . ":host=" . dbEndereco . ";dbname=" . dbNome, dbUsuario, dbSenha );

        $sql = "SELECT * FROM $tabela WHERE email_Estd = :email_Estd AND senha_Estd = :senha_Estd";

        $stm = $conexao->prepare( $sql );
        $stm->bindValue(":email_Estd", $email);
        $stm->bindValue(":senha_Estd", $senha);

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