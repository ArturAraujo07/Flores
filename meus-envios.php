<?php require 'pages/header.php'; ?>

<?php 
    if(empty($_SESSION['cLogin'])) {
        ?>
        <script type="text/javascript" >window.location.href="login.php";</script>
        <?php
        exit;
    }
?>
<div class="container">
    <h1>Meus Envios</h1>

    <a href="add-registro.php" class="btn btn-default">Adicionar Registro</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Título</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php 
            require 'classes/envios.class.php';
            $a = new Envios();
            $envios = $a->getMeusEnvios();

            foreach($envios as $envio):
        ?>
        <tr>
            <td><img src="assets/images/envios/<?php echo $envio['url']; ?>" border=""></td>
            <td><?php echo $envio['titulo']; ?></td>
            <td></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php require 'pages/footer.php'; ?>