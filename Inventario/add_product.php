<?php
  $page_title = 'Agregar producto';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('recepciono', 'folio_sn', 'contacto_usuario', 'usuario', 'contrasena', 'equipo', 'modelo', 'marca', 'placa_af', 'accesorios', 'sn', 'problemas_equipo', 'programas', 'diagnostico');
   validate_fields($req_fields);
   if(empty($errors)){
     $recepciono  = remove_junk($db->escape($_POST['recepciono']));
     $folio_sn    = remove_junk($db->escape($_POST['folio_sn']));
     $contacto_usuario = remove_junk($db->escape($_POST['contacto_usuario']));
     $usuario     = remove_junk($db->escape($_POST['usuario']));
     $contrasena  = remove_junk($db->escape($_POST['contrasena']));
     $equipo      = remove_junk($db->escape($_POST['equipo']));
     $modelo      = remove_junk($db->escape($_POST['modelo']));
     $marca       = remove_junk($db->escape($_POST['marca']));
     $placa_af    = remove_junk($db->escape($_POST['placa_af']));
     $accesorios  = remove_junk($db->escape($_POST['accesorios']));
     $sn          = remove_junk($db->escape($_POST['sn']));
     $problemas_equipo = remove_junk($db->escape($_POST['problemas_equipo']));
     if (isset($_POST['programas'])) {
      $programasSeleccionados = $_POST['programas']; // Esto será un array con los programas seleccionados
      foreach ($programasSeleccionados as $programa) {
        // Procesa cada programa seleccionado
        echo $programa . "<br>";
      }
    }  
     $diagnostico = remove_junk($db->escape($_POST['diagnostico']));
     $date        = make_date();
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
      $media_id = '0';
    } else {
      $media_id = remove_junk($db->escape($_POST['product-photo']));
    }


     $query  = "INSERT INTO products (recepciono, folio_sn, contacto_usuario, usuario, contrasena, equipo, modelo, marca, placa_af, accesorios, sn, problemas_equipo, programas, diagnostico, date, media_id) ";
     $query .= "VALUES ('{$recepciono}', '{$folio_sn}', '{$contacto_usuario}', '{$usuario}', '{$contrasena}', '{$equipo}', '{$modelo}', '{$marca}', '{$placa_af}', '{$accesorios}', '{$sn}', '{$problemas_equipo}', '{$programas}', '{$diagnostico}', '{$date}', '{$media_id}')";
     if($db->query($query)){
       $session->msg('s',"Equipo agregado exitosamente.");
       redirect('add_product.php', false);
     } else {
       $session->msg('d','Lo siento, registro falló.');
       redirect('add_product.php', false);
     }
   } else {
     $session->msg("d", $errors);
     redirect('add_product.php', false);
   }
 }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-9">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar Equipo</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_product.php" class="clearfix">
          <!-- Recepciono -->
          <div class="form-group">
            <label for="recepciono">Recepciono</label>
            <input type="text" class="form-control" name="recepciono" placeholder="Recepciono">
          </div>

          <!-- Fecha (Automática) -->
          <input type="hidden" name="date" value="<?php echo make_date(); ?>">

          <!-- Folio Service Now -->
          <div class="form-group">
            <label for="folio_sn">Folio Service Now</label>
            <input type="number" class="form-control" name="folio_sn" placeholder="Folio Service Now">
          </div>

          <!-- Contacto de Usuario -->
          <div class="form-group">
            <label for="contacto_usuario">Contacto de Usuario</label>
            <input type="number" class="form-control" name="contacto_usuario" placeholder="Contacto de Usuario">
          </div>

          <!-- Usuario y Contraseña -->
          <div class="form-group">
            <label for="usuario">Usuario</label>
            <input type="text" class="form-control" name="usuario" placeholder="Usuario">
          </div>
          <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="text" class="form-control" name="contrasena" placeholder="Contraseña">
          </div>
</div>
          
</div>
      




  <!-- /******************** */ -->
  <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Datos del Equipo</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_product.php" class="clearfix">
          <!-- Equipo, Modelo, Marca -->
          <div class="form-group">
            <label for="equipo">Equipo</label>
            <input type="text" class="form-control" name="equipo" placeholder="Equipo">
          </div>
          <div class="form-group">
            <label for="modelo">Modelo</label>
            <input type="text" class="form-control" name="modelo" placeholder="Modelo">
          </div>
          <div class="form-group">
            <label for="marca">Marca</label>
            <input type="text" class="form-control" name="marca" placeholder="Marca">
          </div>

          <!-- Placa de AF -->
          <div class="form-group">
            <label for="placa_af">Placa de AF</label>
            <input type="number" class="form-control" name="placa_af" placeholder="Placa de AF">
          </div>

          <!-- Accesorios y S/N -->
          <div class="form-group">
            <label for="accesorios">Accesorios</label>
            <input type="text" class="form-control" name="accesorios" placeholder="Accesorios">
          </div>
          <div class="form-group">
            <label for="sn">S/N</label>
            <input type="text" class="form-control" name="sn" placeholder="S/N">
          </div>
      </div>
</div>

      
  <!-- /******************** */ -->
  <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Problemas del Equipo</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_product.php" class="clearfix">
           <!-- Problemas del Equipo -->
           <div class="form-group">
            <label for="problemas_equipo">Problemas del Equipo</label>
            <textarea class="form-control" name="problemas_equipo" placeholder="Describa los problemas del equipo"></textarea>
          </div>
          </div>
</div>

 <!-- /******************** */ -->
 <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Programas a Instalar, URL´s u Otros</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_product.php" class="clearfix">
       <!-- Programas a Instalar -->
<div class="form-group">
  <label for="programas">Programas a Instalar</label>
  <div>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Opera"> Opera
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Teams"> Teams
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Forticlient"> Forticlient
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="SAP"> SAP
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Office"> Office
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Avaya"> Avaya
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="AX"> AX
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Canto"> Canto
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Cenas y Exclusivo"> Cenas y Exclusivo
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Saturno"> Saturno
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Sirex"> Sirex
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Sivex"> Sivex
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Sox"> Sox
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Spasoft"> Spasoft
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Hotsos"> Hotsos
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Salto"> Salto
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Successfactor"> Successfactor
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Salesforce"> Salesforce
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Sivex BackOffice"> Sivex BackOffice
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Spotfire"> Spotfire
    </label>
    <label class="checkbox-inline">
      <input type="checkbox" name="programas[]" value="Delphi"> Delphi
    </label>
  </div>
</div>
          <div class="form-group">
            <label for="Otros">Otros</label>
            <textarea class="form-control" name="Otros" placeholder="Otros"></textarea>
          </div>

          </div>
</div>


     
  <!-- /******************** */ -->
  <div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Diagnostico Tecnico o Procesos</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_product.php" class="clearfix">
           <!-- Diagnostico Tecnico o Procesos-->
           <div class="form-group">
            <label for="Diagnostico_Tecico_o_Procesos">Diagnostico Tecnico o Procesos</label>
            <textarea class="form-control" name="Diagnostico_Tecico_o_Procesos" placeholder="Describa el Diagnostico Tecico o Procesos"></textarea>
          </div>
          </div>
</div>

  <!-- /******************** */ -->
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar Imagen</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_product.php" class="clearfix">
           <!-- Diagnostico Tecnico o Procesos-->
           <div class="form-group">
            
          </div>
          </div>
</div>




          
              <button type="submit" name="add_product" class="btn btn-danger">Agregar Equipo</button>
          </form>
         </div>
        </div>
      </div>
    </div>
  </div>




<?php include_once('layouts/footer.php'); ?>
