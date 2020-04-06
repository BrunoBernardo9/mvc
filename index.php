<?php

	// Verifica se já existe uma sessão, antes de abrir uma nova.
	if (session_status() !== PHP_SESSION_ACTIVE) 
		session_start();

	require_once "app/config/Constante.php";
	require_once "app/Route.php";

	$Route = new Route;
	$Route->iniciarAplicacao();
	
?>