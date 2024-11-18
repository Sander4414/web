<?php 
session_start();
include('db_connect.php');
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM folders where id=".$_GET['id']);
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $v){
			$meta[$k] = $v;
		}
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-compartir">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
		<input type="hidden" name="carpeta_id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
		<input type="hidden" name="parent_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>">
		<div class="form-group">
			<label for="name" class="control-label"><i class="fa fa-folder"></i> Nombre de la Carpeta</label>
			<input type="text" readonly="readonly" name="name" id="name" value="<?php echo isset($meta['name']) ? $meta['name'] :'' ?>" class="form-control">
		</div>
		<div class="form-group">
		<label><i>Compartir con: </i></label>
		<div class="row">
		<?php include 'db_connect.php'; ?>
		<?php $query = $conn -> query ("SELECT * FROM users");
          while ($valores = mysqli_fetch_array($query)) { 

          	$user = $valores['id'];
            $carpeta = $_GET['id'];

			if ($user == $_SESSION['login_id']) {
				continue;
			}
            $existe = $conn -> query ("SELECT * FROM compartircarpeta where usuario_id=$user and carpeta_id=$carpeta");
            $ver = $existe->num_rows;
            $marcar = "";
            if ($ver ==1) {
              $marcar="checked";
            }

          	?>
          	<div class="col-md-6">
          		<input id="user_<?php echo $valores['id']; ?>" type="checkbox" name="usuario_id[]"  value="<?php echo $valores['id']; ?>" <?php echo $marcar; ?>>
				<label for="user_<?php echo $valores['id']; ?>"> <?php echo $valores['name']; ?></label>
          	</div>
		<?php } ?>
		</div>
	</div>
	</form>
	<div class="form-group" id="msg"></div>
</div>
<script>
	$('#manage-compartir').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_compartir',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Datos guardados correctamente",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					window.location='index.php?page=files';
				}
			}
		})
	})
</script>