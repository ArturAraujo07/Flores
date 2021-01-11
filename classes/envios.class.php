<?php
class Envios {

    public function getMeusEnvios() {
        global $pdo;

        $array = array();
        $sql = $pdo->prepare("SELECT *,
        (select envio_imagens.url from envio_imagens where envio_imagens.id_envios = envio.id limit 1)
        as url FROM envios WHERE id_usuario = :id_usuario");
        $sql->bindValue(":id_usuario", $_SESSION['cLogin']);
        $sql->execute();

        if($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function addRegistro($titulo, $categoria, $descricao, $meses) {
        global $pdo;

        $sql = $pdo->prepare("INSERT INTO anuncios SET titulo = :titulo, id_categoria = :id_categoria,
        id_usuario = :id_usuario, descricao = :descricao, meses = :meses");
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":meses", $meses);
		$sql->execute();
    }
}
?>