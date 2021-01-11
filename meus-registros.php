<?php require 'pages/header.php'; ?>
<?php
if(empty($_SESSION['cLogin'])) {
	?>
	<script type="text/javascript">window.location.href="login.php";</script>
	<?php
	exit;
}
?>
<div class="container">
	<h1>Meus Registros</h1>

	<a href="add-registro.php" class="btn btn-default">Adicionar Registro</a>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Foto</th>
				<th>Titulo</th>
				<th>Ações</th>
			</tr>
		</thead>
		<?php
		require 'classes/registros.class.php';
		$a = new Registros();
		$registros = $a->getMeusRegistros();

		foreach($registros as $registro):
		?>
		<tr>
			<td>
				<?php if(!empty($registro['url'])): ?>
				<img src="assets/images/registros/<?php echo $registro['url']; ?>" height="50" border="0" />
				<?php else: ?>
				<img src="assets/images/default.jpg" height="50" border="0" />
				<?php endif; ?>
			</td>
			<td><?php echo $registro['titulo']; ?></td>
			
			<td>
				<a href="editar-registro.php?id=<?php echo $registro['id']; ?>" class="btn btn-default">Editar</a>
				<a href="excluir-registro.php?id=<?php echo $registro['id']; ?>" class="btn btn-danger">Excluir</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>
<?php require 'pages/footer.php'; ?>