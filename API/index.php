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

        } catch () {

        }

    } else {

    }

} else {

}

?>