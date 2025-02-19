<?php
  $page_title = 'Gestión de Contraseñas';
  require_once('includes/load.php');
?>
<?php
// Verifica el nivel de permisos del usuario
page_require_level(1);

// Obtiene todos los registros de la tabla 'contraseñas'
$all_passwords = find_all_passwords(); 
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
   <div class="col-md-12">
     <?php echo display_msg($msg); ?>
   </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Contraseñas</span>
       </strong>
         <a href="add_password.php" class="btn btn-info pull-right">Agregar Contraseña</a>
      </div>
     <div class="panel-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center" style="width: 50px;">#</th>
            <th>Aplicación</th>
            <th>Usuario</th>
            <th>Contraseña</th>
            <th>Última Actualización</th>
            <th class="text-center" style="width: 100px;">Operaciones</th>
          </tr>
        </thead>
        <tbody>
            
        <?php foreach($all_passwords as $password): ?>
  <tr>
    <td class="text-center"><?php echo count_id(); ?></td>
    <td><?php echo remove_junk(ucwords($password['app'])); ?></td>
    <td><?php echo remove_junk($password['usuario']); ?></td>
    <td>
      <div class="password-container">
        <span class="password-text" style="display: none;">
          <?php 
            $decrypted_password = decrypt_password($password['contrasena'], 'miClaveDeEncriptacion');
            echo $decrypted_password ? remove_junk($decrypted_password) : 'Error al desencriptar'; 
          ?>
        </span>
        <span class="password-placeholder">******</span>
        <button type="button" class="toggle-password btn btn-xs btn-info" style="margin-left: 5px;">
          Mostrar
        </button>
      </div>
    </td>
    <td><?php echo read_date($password['ultimo_login']); ?></td>
    <td class="text-center">
      <div class="btn-group">
        <a href="edit_password.php?id=<?php echo (int)$password['id']; ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Editar">
          <i class="glyphicon glyphicon-pencil"></i>
        </a>
        <a href="delete_password.php?id=<?php echo (int)$password['id']; ?>" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Eliminar">
          <i class="glyphicon glyphicon-remove"></i>
        </a>
      </div>
    </td>
  </tr>
<?php endforeach; ?>

</tbody>

<script>
  document.addEventListener("DOMContentLoaded", () => {
  console.log("Script ejecutado"); // Verifica en la consola del navegador

  const toggleButtons = document.querySelectorAll(".toggle-password");

  toggleButtons.forEach(button => {
    button.addEventListener("click", () => {
      const container = button.parentElement;
      const passwordText = container.querySelector(".password-text");
      const passwordPlaceholder = container.querySelector(".password-placeholder");

      if (passwordText.style.display === "none" || passwordText.style.display === "") {
        // Mostrar contraseña
        passwordText.style.display = "inline";
        passwordPlaceholder.style.display = "none";
        button.textContent = "Ocultar";
      } else {
        // Ocultar contraseña
        passwordText.style.display = "none";
        passwordPlaceholder.style.display = "inline";
        button.textContent = "Mostrar";
      }
    });
  });
});

</script>

</tbody>

     </table>
     </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
