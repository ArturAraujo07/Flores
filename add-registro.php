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

	$a->addRegistro($titulo, $categoria, $descricao, $meses);

	?>
	<div class="alert alert-success">
		Produto adicionado com sucesso!
	</div>
	<?php
}
?>
<div class="container">
	<h1>Meus Registros - Adicionar Flor</h1>

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
				<option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
				<?php
				endforeach;
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="titulo">Nome da Flor:</label>
			<input type="text" name="titulo" id="titulo" class="form-control" />
		</div>
		<div class="form-group">
			<label for="descricao">Descrição da flor:</label>
			<textarea class="form-control" name="descricao"></textarea>
		</div>
		<div class="form-group">
            <label for="meses">Mês:</label>
            <select name="meses" id="meses" class="form-control">
				<option value="0">Janeiro</option>
				<option value="1">Fevereiro</option>
				<option value="2">Março</option>
				<option value="3">Abril</option>
				<option value="4">Maio</option>
				<option value="5">Junho</option>
				<option value="6">Julho</option>
				<option value="7">Agosto</option>
				<option value="6">Setembro</option>
				<option value="9">Outubro</option>
				<option value="10">Novembro</option>
				<option value="11">Dezembro</option>
			</select>
        </div>
		<input type="submit" value="Adicionar" class="btn btn-default" />
	</form>

</div>
<?php require 'pages/footer.php'; ?>