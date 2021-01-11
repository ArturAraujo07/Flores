<?php
session_start();

global $pdo;
try {
	$pdo = new PDO("mysql:dbname=abelhas_flores;host=localhost", "root", "");
} catch(PDOException $e) {
	echo "FALHOU: ".$e->getMessage();
	exit;
}
?>