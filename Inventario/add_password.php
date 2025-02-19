<?php
$page_title = 'Agregar Contraseña';
require_once('includes/load.php');
page_require_level(1);

if (isset($_POST['add_password'])) {
    $req_fields = array('app-name', 'username', 'password');
    validate_fields($req_fields);

    if (empty($errors)) {
        $app = remove_junk($db->escape($_POST['app-name']));
        $username = remove_junk($db->escape($_POST['username']));
        $password = remove_junk($db->escape($_POST['password']));
       

        // Encriptar la contraseña con openssl
        $encryption_key = 'miClaveDeEncriptacion'; // Cambia esto por una clave más segura
        $encrypted_password = openssl_encrypt(
            $password,
            'AES-128-ECB',
            $encryption_key
        );

        $query = "INSERT INTO contrasenas (app, usuario, contrasena) VALUES (";
        $query .= "'{$app}', '{$username}', '{$encrypted_password}')";
        
        if ($db->query($query)) {
            $session->msg('s', "Contraseña añadida exitosamente.");
            redirect('add_password.php', false);
        } else {
            $session->msg('d', 'No se pudo añadir la contraseña.');
            redirect('add_password.php', false);
        }
    } else {
        $session->msg("d", $errors);
        redirect('add_password.php', false);
    }
}
?>

<?php include_once('layouts/header.php'); ?>
<?php echo display_msg($msg); ?>

<!-- Formulario HTML -->
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Agregar Contraseña</span>
        </strong>
    </div>
    <div class="panel-body">
        <div class="col-md-6">
            <form method="post" action="add_password.php">
                <div class="form-group">
                    <label for="app-name">Aplicación</label>
                    <input type="text" class="form-control" name="app-name" placeholder="Nombre de la aplicación" required>
                </div>
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" class="form-control" name="username" placeholder="Usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
                </div>
                <div class="form-group clearfix">
                    <button type="submit" name="add_password" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>