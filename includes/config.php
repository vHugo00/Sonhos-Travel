<?php

	/**
	 * 
	 * Este é oa rquivo de configuração principal do CRUD.
	 * Ele contém variáveis de ambiente e as constantes de conexão com o banco de dados.
	 * Alterações neste arquivo afetarão todo o sistema.
	 * 
	 * 
	 */

	// URL do servidor
	DEFINE ('APP_URL', "http://localhost");

	// Nome da sessão. Não é necessário alterar
	DEFINE ('SESSION_NAME', sha1('u24ever' . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

	// Configurações de fuso horário e localidade
	date_default_timezone_set('America/Sao_Paulo');
	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

	// Constantes de conexão com o banco de dados
	DEFINE ('DB_NAME', 'vitorhugo' );
	DEFINE ('DB_USER', 'root' );
	DEFINE ('DB_PASSWORD', '' );
	DEFINE ('DB_HOST', 'localhost' );
	DEFINE ('DB_CHARSET', 'utf8mb4' );

	// Constantes de dados do contrato
	DEFINE ('VALOR', '1.200,00' );
	DEFINE ('INICIO', '12' );
	DEFINE ('TERMINO', '24/12/24' );

	// Conexão com o banco de dados
	try {
		
		$conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	} catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

	// Inclui o arquivo de funções e
	// chama a função de limpeza de saída
	require_once('functions.php');
	ob_start("sanitize_output");

?>