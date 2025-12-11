<?php
header('Content-Type: application/json; charset=utf-8');

include_once "CursosService.php" ;
include_once "EstudanteService.php" ;
include_once "InstituicaoService.php" ;
include_once "InscricaoService.php" ;
include_once "util.php" ;
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Access-Control-Allow-Headers: *");

// Permitir CORS e preflight
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

//Rota exclusiva para o login
if (strtolower(@$_GET["url"]) === "1/login") {
    try {
        $service = new EstudanteService();
        $response = $service->login();
        http_response_code(200);
        echo FormatarMensagemJson($response["erro"], $response["mensagem"], $response["dados"]);

    } catch ( Exception $erro ) {
        http_response_code(500);
        echo FormatarMensagemJson(true, $erro -> getMessage(), []);

    }
    exit;
}

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
        //echo "Service: $service / " ;
        //echo "Method: $method " ;
        //echo PHP_EOL;

        try {
            // --- ROTA NOVA ESPECIAL DE INSCRICAO/VERIFICAR ---
            if ($service === "InscricaoService" && isset($url[0]) && $url[0] === "verificar") {

                $cpf = $url[1] ?? null;
                $idCurso = $url[2] ?? null;

                if (!$cpf || !$idCurso) {
                    throw new Exception("É necessário informar CPF e ID do curso.");
                }

                $serviceObj = new InscricaoService();
                $response = $serviceObj->verificar($cpf, $idCurso);

                http_response_code(200);
                echo FormatarMensagemJson($response["erro"], $response["mensagem"], $response["dados"]);
                exit;
            }

            $response = call_user_func_array( array( new $service, $method ), $url );
            http_response_code(200);
            echo FormatarMensagemJson($response["erro"], $response["mensagem"], $response["dados"]);

        } catch ( Exception $erro ) {
            http_response_code(500);
            echo FormatarMensagemJson(true, $erro -> getMessage(), []);

        }

    } else {
        echo "EndPoint incorreto.";
    }

} else {
    echo "Nenhum EndPoint foi informado.";

}

?>