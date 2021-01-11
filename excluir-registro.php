<?php
require 'config.php';
if(empty($_SESSION['cLogin'])) {
	header("Location: login.php");
	exit;
}

require 'classes/registros.class.php';
$a = new Registros();

if(isset($_GET['id']) && !empty($_GET['id'])) {
	$a->excluirRegistro($_GET['id']);
}

header("Location: meus-registros.php");