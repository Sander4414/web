<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>filesystem</title>
  <?php
   session_start();
   if(!isset($_SESSION['login_id']))
   header('location:login.php');
   include('./header.php'); 
   // include('./auth.php'); 
 ?>
</head>
<style>
	body{
    background: #80808045;
  }
</style>
<body>
	<?php include 'topbar.php' ?>
	<?php include 'navbar.php' ?>
  <nav aria-label="breadcrumb ">
    <ol class="breadcrumb">
    </ol>
  </nav>
  <div class="container-fluid">
    <div class="col-lg-12">
      <br><br>
      <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-9">
          <?php
            include('db_connect.php');
            if (isset($_GET['id'])) {
              $qry = $conn->query("SELECT * FROM files where id=" . $_GET['id']);
              if ($qry->num_rows > 0) {
                foreach ($qry->fetch_array() as $k => $v) {
                  $meta[$k] = $v;
                }
              }
            }
          ?>
          <div class="container-fluid">
            <form action="c_archivo.php" method="post">
              <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
              <input type="hidden" name="archivo_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
              <input type="hidden" name="folder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] : '' ?>">
    <div class="form-group">
    <label><i>Compartir con los Usuarios: </i></label>
    <div class="row">
    <?php include 'db_connect.php'; ?>
    <?php $query = $conn -> query ("SELECT * FROM users");
          while ($valores = mysqli_fetch_array($query)) { 
            $user = $valores['id'];
            $archivo = $_GET['id'];
            if ($user == $_SESSION['login_id']) {
              continue;
            }
            $existe = $conn -> query ("SELECT * FROM compartirarchivo where usuario_id=$user and archivo_id=$archivo");
            $ver = $existe->num_rows;
            $marcar = "";
            if ($ver ==1) {
              $marcar="checked";
            }
            ?>
            <div class="col-md-4">
              <input id="user_<?php echo $valores['id']; ?>" type="checkbox" name="usuario_id[]"  value="<?php echo $valores['id']; ?>" <?php echo $marcar; ?>>
        <label for="user_<?php echo $valores['id']; ?>"> <?php echo $valores['name']; ?></label>
            </div>
    <?php } ?>
    </div>
  </div>
    <div class="form-group" id="msg"></div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Guardar</button>
      <a href="#" class="btn btn-secondary" onclick="window.location='index.php?page=files' ">Cancelar</a>
    </div>
  </form>
</div>

</div> 
</div>
</div>
</div>
</div>
</body>	
</html>