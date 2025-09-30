<?php

include_once "CursosService.php" ;
include_once "EstudanteService.php" ;
include_once "InstituicaoService.php" ;
include_once "InscricaoService.php" ;
include_once "util.php" ;

if (@$_GET["url"]) {
    
    $url = explode("/", @$_GET["url"]);
    //http://localhost/ProjetoPontedoSaber/API/1/Cursos/
    //http://localhost/ProjetoPontedoSaber/API/1/Estudante/
    //http://localhost/ProjetoPontedoSaber/API/1/Instituicao/
    //http://localhost/ProjetoPontedoSaber/API/1/Inscricao/
        
    if($url[0] === "1") {
        array_shift($url);
        
        $service = ucfirst($url[0])."Service";
        array_shift($url);

        //ucfirst= deixa a primeira letra maiuscula e strtolower = deixa o resto minusculo
        $method = ucfirst(strtolower($_SERVER["REQUEST_METHOD"])); 
        echo "Service: $service <br> Method: $method <br><br>";

        try {
            $response = call_user_func_array( array( new $service, $method ), $url );
            http_response_code(200);
            echo FormatarMensagemJson($response["erro"], $response["mensagem"], $response["dados"]);

        } catch ( Exception $erro ) {
            http_response_code(500);
            echo FormatarMensagemJson(true, $erro -> getMessage(), []);

        }

    } else {
        echo "<br>";
        echo "EndPoint incorreto.";
    }

} else {
    echo "<br>";
    echo "Nenhum EndPoint foi informado.";

}

?>