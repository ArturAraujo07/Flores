<?php require 'pages/header.php'; ?>
<?php
if(empty($_SESSION['cLogin'])) {
	?>
	<script type="text/javascript">window.location.href="login.php";</script>
	<?php
	exit;
}

require 'classes/registros.class.php';
$a = new Registros();
if(isset($_POST['titulo']) && !empty($_POST['titulo'])) {
	$titulo = addslashes($_POST['titulo']);
	$categoria = addslashes($_POST['categoria']);
	$descricao = addslashes($_POST['descricao']);
	$meses = addslashes($_POST['meses']);
	if(isset($_FILES['fotos'])) {
		$fotos = $_FILES['fotos'];
	} else {
		$fotos = array();
	}

	$a->editRegistro($titulo, $categoria, $descricao, $meses, $fotos, $_GET['id']);

	?>
	<div class="alert alert-success">
		Produto editado com sucesso!
	</div>
	<?php
}

if(isset($_GET['id']) && !empty($_GET['id'])) {
	$info = $a->getRegistro($_GET['id']);
} else {
	?>
	<script type="text/javascript">window.location.href="meus-registros.php";</script>
	<?php
	exit;
}
?>
<div class="container">
	<h1>Meus Registros - Editar Flor</h1>

	<form method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label for="categoria">Selecione a abelha:</label>
			<select name="categoria" id="categoria" class="form-control">
				<?php
				require 'classes/categorias.class.php';
				$c = new Categorias();
				$cats = $c->getLista();
				foreach($cats as $cat):
				?>
				<option value="<?php echo $cat['id']; ?>" <?php echo ($info['id_categoria']==$cat['id'])?'selected="selected"':''; ?>><?php echo $cat['nome']; ?></option>
				<?php
				endforeach;
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="titulo">Nome da Flor:</label>
			<input type="text" name="titulo" id="titulo" class="form-control" value="<?php echo $info['titulo']; ?>" />
		</div>
		<div class="form-group">
			<label for="descricao">Descrição da flor:</label>
			<textarea class="form-control" name="descricao"><?php echo $info['descricao']; ?></textarea>
		</div>
		<div class="form-group">
			<label for="meses">Mês:</label>
			<select name="meses" id="meses" class="form-control">
				<option value="0" <?php echo ($info['meses']=='0')?'selected="selected"':''; ?>>Janeiro</option>
				<option value="1" <?php echo ($info['meses']=='1')?'selected="selected"':''; ?>>Fevereiro</option>
				<option value="2" <?php echo ($info['meses']=='2')?'selected="selected"':''; ?>>Março</option>
				<option value="3" <?php echo ($info['meses']=='3')?'selected="selected"':''; ?>>Abril</option>
				<option value="4" <?php echo ($info['meses']=='4')?'selected="selected"':''; ?>>Maio</option>
				<option value="5" <?php echo ($info['meses']=='5')?'selected="selected"':''; ?>>Junho</option>
				<option value="6" <?php echo ($info['meses']=='6')?'selected="selected"':''; ?>>Julho</option>
				<option value="7" <?php echo ($info['meses']=='7')?'selected="selected"':''; ?>>Agosto</option>
				<option value="6" <?php echo ($info['meses']=='8')?'selected="selected"':''; ?>>Setembro</option>
				<option value="9" <?php echo ($info['meses']=='9')?'selected="selected"':''; ?>>Outubro</option>
				<option value="10" <?php echo ($info['meses']=='10')?'selected="selected"':''; ?>>Novembro</option>
				<option value="11" <?php echo ($info['meses']=='11')?'selected="selected"':''; ?>>Dezembro</option>
			</select>
		</div>
		<div class="form-group">
			<label for="add_foto">Fotos da flor:</label>
			<input type="file" name="fotos[]" multiple /><br/>

			<div class="panel panel-default">
				<div class="panel-heading">Fotos da Flor</div>
				<div class="panel-body">
					<?php foreach($info['fotos'] as $foto): ?>
					<div class="foto_item">
						<img src="assets/images/registros/<?php echo $foto['url']; ?>" class="img-thumbnail" border="0" /><br/>
						<a href="excluir-foto.php?id=<?php echo $foto['id']; ?>" class="btn btn-default">Excluir Imagem</a>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>

		<input type="submit" value="Salvar" class="btn btn-default" />
	</form>

</div>
<?php require 'pages/footer.php'; ?>