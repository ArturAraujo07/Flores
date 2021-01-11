<?php
require 'config.php';
if(empty($_SESSION['cLogin'])) {
	header("Location: login.php");
	exit;
}

require 'classes/registros.class.php';
$a = new Registros();

if(isset($_GET['id']) && !empty($_GET['id'])) {
	$id_registro = $a->excluirFoto($_GET['id']);
}

if(isset($id_registro)) {
	header("Location: editar-registro.php?id=".$id_registro);
} else {
	header("Location: meus-registros.php");
}