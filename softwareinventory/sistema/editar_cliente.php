<?php
include_once "includes/header.php";
if (!empty($_POST)) {
  $alert = "";
  if (empty($_POST['idcliente']) || empty($_POST['nombre']) || empty($_POST['direccion']) || empty($_POST['telefono']) || empty($_POST['email'])) {
    $alert = '<div class="alert alert-primary" role="alert">
              Todo los campos son requeridos
            </div>';
  } else {
    $idcliente = $_GET['id'];
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $query_update = mysqli_query($conectar, "UPDATE clientes SET idcliente = '$idcliente', nombre = '$nombre', direccion = '$direccion', telefono = '$telefono', email = '$email' WHERE idcliente = $idcliente");
    if ($query_update) {
      $alert = '<div class="alert alert-primary" role="alert">
              Modificado
            </div>';
    } else {
      $alert = '<div class="alert alert-primary" role="alert">
                Error al Modificar
              </div>';
    }
  }
}

// Validar producto

if (empty($_REQUEST['id'])) {
  header("Location: listar_cliente.php");
} else {
  $idcliente = $_REQUEST['id'];
  if (!is_numeric($idcliente)) {
    header("Location: listar_cliente.php");
  }
  $query_producto = mysqli_query($conectar, "SELECT * FROM clientes WHERE idcliente = $idcliente");
  $result_producto = mysqli_num_rows($query_producto);

  if ($result_producto > 0) {
    $data_producto = mysqli_fetch_assoc($query_producto);
  } else {
    header("Location: listar_cliente.php");
  }
}
?>
		<!-- Contenido -->
		<div id="contenido">		
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                    <div class="card">
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Panel Edición Clientes</h1>
                            <a href="listar_cliente.php" class="btn btn-primary">Regresar</a>
                        </div>
                        <div class="card-body">
                        <form action="" method="post">
                            <?php echo isset($alert) ? $alert : ''; ?>
                            <div class="form-group">
                            <label for="idcliente">Identificacion</label>
                            <input type="number" class="form-control" placeholder="Ingrese Identificacion" name="idcliente" id="idcliente" value="<?php echo $data_producto['idcliente']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" placeholder="Ingrese Nombre" name="nombre" id="nombre" value="<?php echo $data_producto['nombre']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="direccion">Direccion</label>
                            <input type="text" class="form-control" placeholder="Ingrese Direccion" name="direccion" id="direccion" value="<?php echo $data_producto['direccion']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="telefono">Telefono</label>
                            <input type="number" class="form-control" placeholder="Ingrese Telefono" name="telefono" id="telefono" value="<?php echo $data_producto['telefono']; ?>">
                            </div>
                            <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" placeholder="Ingrese Email" name="email" id="email" value="<?php echo $data_producto['email']; ?>">
                            </div>
                            <input type="submit" value="Actualizar" class="btn btn-primary">
                        </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
		</div>
<?php include_once "includes/footer.php"; ?>