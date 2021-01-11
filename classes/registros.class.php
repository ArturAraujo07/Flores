<?php
class Registros {

	public function getTotalRegistros($filtros) {
		global $pdo;

		$filtrostring = array('1=1');
		if(!empty($filtros['categoria'])) {
			$filtrostring[] = 'registros.id_categoria = :id_categoria';
		}
		if(!empty($filtros['meses'])) {
			$filtrostring[] = 'registros.meses = :meses';
		}

		$sql = $pdo->prepare("SELECT COUNT(*) as c FROM registros WHERE ".implode(' AND ', $filtrostring));

		if(!empty($filtros['categoria'])) {
			$sql->bindValue(':id_categoria', $filtros['categoria']);
		}
		if(!empty($filtros['preco'])) {
			$preco = explode('-', $filtros['preco']);
			$sql->bindValue(':preco1', $preco[0]);
			$sql->bindValue(':preco2', $preco[1]);
		}
		if(!empty($filtros['meses'])) {
			$sql->bindValue(':meses', $filtros['meses']);
		}

		$sql->execute();
		$row = $sql->fetch();

		return $row['c'];
	}

	public function getUltimosRegistros($page, $perPage, $filtros) {
		global $pdo;

		$offset = ($page - 1) * $perPage;

		$array = array();

		$filtrostring = array('1=1');
		if(!empty($filtros['categoria'])) {
			$filtrostring[] = 'registros.id_categoria = :id_categoria';
		}
		if(!empty($filtros['meses'])) {
			$filtrostring[] = 'registros.meses = :meses';
		}

		$sql = $pdo->prepare("SELECT
			*,
			(select registros_imagens.url from registros_imagens where registros_imagens.id_registro = registros.id limit 1) as url,
			(select categorias.nome from categorias where categorias.id = registros.id_categoria) as categoria
			FROM registros WHERE ".implode(' AND ', $filtrostring)." ORDER BY id DESC LIMIT $offset, $perPage");
		
		if(!empty($filtros['categoria'])) {
			$sql->bindValue(':id_categoria', $filtros['categoria']);
		}
		if(!empty($filtros['preco'])) {
			$preco = explode('-', $filtros['preco']);
			$sql->bindValue(':preco1', $preco[0]);
			$sql->bindValue(':preco2', $preco[1]);
		}
		if(!empty($filtros['meses'])) {
			$sql->bindValue(':meses', $filtros['meses']);
		}

		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getMeusRegistros() {
		global $pdo;

		$array = array();
		$sql = $pdo->prepare("SELECT
			*,
			(select registros_imagens.url from registros_imagens where registros_imagens.id_registro = registros.id limit 1) as url
			FROM registros
			WHERE id_usuario = :id_usuario");
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getRegistro($id) {
		$array = array();
		global $pdo;

		$sql = $pdo->prepare("SELECT
			*,
			(select categorias.nome from categorias where categorias.id = registros.id_categoria) as categoria
		FROM registros WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$array = $sql->fetch();
			$array['fotos'] = array();

			$sql = $pdo->prepare("SELECT id,url FROM registros_imagens WHERE id_registro = :id_registro");
			$sql->bindValue(":id_registro", $id);
			$sql->execute();

			if($sql->rowCount() > 0) {
				$array['fotos'] = $sql->fetchAll();
			}

		}

		return $array;
	}

	public function addRegistro($titulo, $categoria, $descricao, $meses) {
		global $pdo;

		$sql = $pdo->prepare("INSERT INTO registros SET titulo = :titulo, id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :descricao, meses = :meses");
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":meses", $meses);
		$sql->execute();
	}

	public function editRegistro($titulo, $categoria, $descricao, $meses, $fotos, $id) {
		global $pdo;

		$sql = $pdo->prepare("UPDATE registros SET titulo = :titulo, id_categoria = :id_categoria, id_usuario = :id_usuario, descricao = :descricao, meses = :meses WHERE id = :id");
		$sql->bindValue(":titulo", $titulo);
		$sql->bindValue(":id_categoria", $categoria);
		$sql->bindValue(":id_usuario", $_SESSION['cLogin']);
		$sql->bindValue(":descricao", $descricao);
		$sql->bindValue(":meses", $meses);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if(count($fotos) > 0) {
			for($q=0;$q<count($fotos['tmp_name']);$q++) {
				$tipo = $fotos['type'][$q];
				if(in_array($tipo, array('image/jpeg', 'image/png'))) {
					$tmpname = md5(time().rand(0,9999)).'.jpg';
					move_uploaded_file($fotos['tmp_name'][$q], 'assets/images/registros/'.$tmpname);

					list($width_orig, $height_orig) = getimagesize('assets/images/registros/'.$tmpname);
					$ratio = $width_orig/$height_orig;

					$width = 500;
					$height = 500;

					if($width/$height > $ratio) {
						$width = $height*$ratio;
					} else {
						$height = $width/$ratio;
					}

					$img = imagecreatetruecolor($width, $height);
					if($tipo == 'image/jpeg') {
						$origi = imagecreatefromjpeg('assets/images/registros/'.$tmpname);
					} elseif($tipo == 'image/png') {
						$origi = imagecreatefrompng('assets/images/registros/'.$tmpname);
					}

					imagecopyresampled($img, $origi, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

					imagejpeg($img, 'assets/images/registros/'.$tmpname, 80);

					$sql = $pdo->prepare("INSERT INTO registros_imagens SET id_registro = :id_registro, url = :url");
					$sql->bindValue(":id_registro", $id);
					$sql->bindValue(":url", $tmpname);
					$sql->execute();

				}
			}
		}

	}

	public function excluirRegistro($id) {
		global $pdo;

		$sql = $pdo->prepare("DELETE FROM registros_imagens WHERE id_registro = :id_registro");
		$sql->bindValue(":id_registro", $id);
		$sql->execute();

		$sql = $pdo->prepare("DELETE FROM registros WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();
	}

	public function excluirFoto($id) {
		global $pdo;

		$id_registro = 0;

		$sql = $pdo->prepare("SELECT id_registro FROM registros_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$row = $sql->fetch();
			$id_registro = $row['id_registro'];
		}

		$sql = $pdo->prepare("DELETE FROM registros_imagens WHERE id = :id");
		$sql->bindValue(":id", $id);
		$sql->execute();

		return $id_registro;
	}

















}