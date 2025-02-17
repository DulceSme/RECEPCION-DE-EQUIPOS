<?php
  $page_title = 'Lista de Equipos';
  require_once('includes/load.php');
  page_require_level(2);
  $products = join_product_table();
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
          <span>Lista de Equipos</span>
        </strong>
        <div class="pull-right">
          <a href="add_product.php" class="btn btn-primary">Agregar Equipo</a>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th class="text-center" style="width: 50px;">#</th>
              <th> Imagen</th>
              <th> Recepcionó </th>
              <th> Folio SN </th>
              <th> Contacto Usuario </th>
              <th> Usuario </th>
              <th> Equipo </th>
              <th> Modelo </th>
              <th> Marca </th>
              <th> Accesorios </th>
              <th> Problemas del Equipo </th>
              <th class="text-center" style="width: 100px;"> Acciones </th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product):?>
            <tr>
              <td class="text-center"><?php echo count_id();?></td>
              <td>
                <?php if($product['media_id'] === '0'): ?>
                  <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
              </td>
              <td> <?php echo remove_junk($product['recepciono']); ?></td>
              <td> <?php echo remove_junk($product['folio_sn']); ?></td>
              <td> <?php echo remove_junk($product['contacto_usuario']); ?></td>
              <td> <?php echo remove_junk($product['usuario']); ?></td>
              <td> <?php echo remove_junk($product['equipo']); ?></td>
              <td> <?php echo remove_junk($product['modelo']); ?></td>
              <td> <?php echo remove_junk($product['marca']); ?></td>
              <td> <?php echo remove_junk($product['accesorios']); ?></td>
              <td> <?php echo remove_junk($product['problemas_equipo']); ?></td>
              <td class="text-center">
                <div class="btn-group">
                  <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-xs" title="Editar" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-edit"></span>
                  </a>
                  <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-xs" title="Eliminar" data-toggle="tooltip">
                    <span class="glyphicon glyphicon-trash"></span>
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
