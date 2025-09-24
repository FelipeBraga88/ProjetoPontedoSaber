<?php

if (@$_GET["url"]) {
    
    $url = explode("/", @$_GET["url"]);
    
    if($url[0] === "api") {
        array_shift($url);
        
        $service = ucfirst($url[0])."Service";
        array_shift($url);
        
        $method = strtolower($_SERVER["REQUEST_METHOD"]);
        echo "Service: $service, Method: $method";
        echo "Method: " . $method . "<br><br>" ;
        //ver qual a diferença entre esses 2 echo de cima.

        try {
            $response = call_user_func_array(array(new $service, $method), $url);
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