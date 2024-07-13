<?php

	/**
	 * 
	 * Este é oa rquivo de configuração principal do CRUD.
	 * Ele contém variáveis de ambiente e as constantes de conexão com o banco de dados.
	 * Alterações neste arquivo afetarão todo o sistema.
	 * 
	 * 
	 */

// Remove espaços em branco, tabulações,
// quebras de linha e comentários para entregar
// HTML mais limpo no navegador
function sanitize_output ($buffer) {

    $search_html = array(
        '/\>[^\S ]+/s',    
        '/[^\S ]+\</s',    
        '/(\s)+/s',        
        '/<!--(.|\s)*?-->/',
        '/\>\s+\</',       
        '/\n/'
    );
    $replace_html = array(
        '>',
        '<',
        '\\1',
        '',
        '><',
        ''
    );
    $buffer = preg_replace($search_html, $replace_html, $buffer);
    
    return $buffer;
}

// Trata os dados recebidos
function sanitizeData($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Gera uma string aleatória
function randStr($length, $type = NULL) {
    $chars = '';

    switch ($type) {
        case 'N':
            $chars = '0123456789';
            break;
        case 'A':
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        default:
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
    }

    $string = '';
    $charsCount = strlen($chars);

    for ($i = 0; $i < $length; $i++) {
        $randomIndex = mt_rand(0, $charsCount - 1);
        $string .= $chars[$randomIndex];
    }

    return $string;
}

?>