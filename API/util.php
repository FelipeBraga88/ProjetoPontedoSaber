<?php
header('Content-Type: application/json; charset=utf-8');

function FormatarMensagemJson( $erro = false, $mensagem = null, $dados = []) {
    return json_encode( 
        array ( 'erro' => $erro , 'mensagem' => $mensagem , 'dados' => $dados ),
        JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
    );
}
   
?>