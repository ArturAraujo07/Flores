<?php require 'pages/header.php'; ?>
<?php
require 'classes/registros.class.php';
require 'classes/usuarios.class.php';
require 'classes/categorias.class.php';
$a = new Registros();
$u = new Usuarios();
$c = new Categorias();

$filtros = array(
	'categoria' => '',
	'meses' => ''
);
if(isset($_GET['filtros'])) {
	$filtros = $_GET['filtros'];
}

$total_registros = $a->getTotalRegistros($filtros);
$total_usuarios = $u->getTotalUsuarios();

$p = 1;
if(isset($_GET['p']) && !empty($_GET['p'])) {
	$p = addslashes($_GET['p']);
}

$por_pagina = 5;
$total_paginas = ceil($total_registros / $por_pagina);

$registros = $a->getUltimosRegistros($p, $por_pagina, $filtros);
$categorias = $c->getLista();
?>

<div class="container-fluid">
	<div class="jumbotron">
		<h2>Nós temos hoje <?php echo $total_registros; ?> registros para essa pesquisa.</h2>
	</div>

	<div class="row">
		<div class="col-sm-3">
			<h4>Pesquisa Avançada</h4>
			<form method="GET">
				<div class="form-group">
					<label for="categoria">Selecione a abelha:</label>
					<select id="categoria" name="filtros[categoria]" class="form-control">
						<option></option>
						<?php foreach($categorias as $cat): ?>
						<option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id']==$filtros['categoria'])?'selected="selected"':''; ?>><?php echo $cat['nome']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				
				<div class="form-group">
					<label for="meses">Mês:</label>
					<select id="meses" name="filtros[meses]" class="form-control">
						<option></option>
						
						<option value="0" <?php echo ($filtros['meses']=='0')?'selected="selected"':''; ?>>Janeiro</option>
						<option value="1" <?php echo ($filtros['meses']=='1')?'selected="selected"':''; ?>>Fevereiro</option>
						<option value="2" <?php echo ($filtros['meses']=='2')?'selected="selected"':''; ?>>Março</option>
						<option value="3" <?php echo ($filtros['meses']=='3')?'selected="selected"':''; ?>>Abril</option>
						<option value="4" <?php echo ($filtros['meses']=='4')?'selected="selected"':''; ?>>Maio</option>
						<option value="5" <?php echo ($filtros['meses']=='5')?'selected="selected"':''; ?>>Junho</option>
						<option value="6" <?php echo ($filtros['meses']=='6')?'selected="selected"':''; ?>>Julho</option>
						<option value="7" <?php echo ($filtros['meses']=='7')?'selected="selected"':''; ?>>Agosto</option>
						<option value="6" <?php echo ($filtros['meses']=='8')?'selected="selected"':''; ?>>Setembro</option>
						<option value="9" <?php echo ($filtros['meses']=='9')?'selected="selected"':''; ?>>Outubro</option>
						<option value="10" <?php echo ($filtros['meses']=='10')?'selected="selected"':''; ?>>Novembro</option>
						<option value="11" <?php echo ($filtros['meses']=='11')?'selected="selected"':''; ?>>Dezembro</option>
					</select>
				</div>

				<div class="form-group">
					<input type="submit" class="btn btn-info" value="Buscar" />
				</div>
			</form>

		</div>
		<div class="col-sm-9">
			<h4>Últimos Registros</h4>
			<table class="table table-striped">
				<tbody>
					<?php foreach($registros as $registro): ?>
					<tr>
						<td>
							<?php if(!empty($registro['url'])): ?>
							<img src="assets/images/registros/<?php echo $registro['url']; ?>" height="50" border="0" />
							<?php else: ?>
							<img src="assets/images/default.jpg" height="50" border="0" />
							<?php endif; ?>
						</td>
						<td>
							<a href="produto.php?id=<?php echo $registro['id']; ?>"><?php echo $registro['titulo']; ?></a><br/>
							<?php echo $registro['categoria']; ?>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>

			<ul class="pagination">
				<?php for($q=1;$q<=$total_paginas;$q++): ?>
				<li class="<?php echo ($p==$q)?'active':''; ?>"><a href="index.php?p=<?php echo $q; ?>"><?php echo $q; ?></a></li>
				<?php endfor; ?>
			</ul>
		</div>
	</div>


</div>

<?php require 'pages/footer.php'; ?>