<nav aria-label="breadcrumb ">
	<ol class="breadcrumb">
		<li class="breadcrumb-item text-black">Usuarios</li>
	</ol>
</nav>
<div class="container-fluid">

	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-success float-right btn-md" style="background-color: #C0392B; border-color: #C0392B" id="new_user"><i class="fa fa-plus"></i> Nuevo Usuario</button>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
					<thead class="bg-dark text-white">
						<tr>
							<th class="text-center">Id</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Nombre de Usuario</th>
							<th class="text-center">Accion</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						$users = $conn->query("SELECT * FROM users order by name asc");
						$i = 1;
						while ($row = $users->fetch_assoc()) :
						?>
							<tr>
								<td>
									<?php echo $i++ ?>
								</td>
								<td>
									<?php echo $row['name'] ?>
								</td>
								<td>
									<?php echo $row['username'] ?>
								</td>
								<td>
									<center>
										<div class="btn-group">
											<button type="button" class="btn btn-primary" style="background-color: #E74C3C; border-color: #E74C3C;" >Accion</button>
											<button type="button" style="background-color: #627D93;" class="btn  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<span class="sr-only">Toggle Dropdown</span>
											</button>
											<div class="dropdown-menu">
												<a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Editar</a>
												<div class="dropdown-divider"></div>
												<a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Eliminar </a>
											</div>
										</div>
									</center>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>
<script>
	$('#new_user').click(function() {
		uni_modal('Nuevo Usuario', 'manage_user.php')
	})
	$('.edit_user').click(function() {
		uni_modal('Editar Usuario', 'manage_user.php?id=' + $(this).attr('data-id'))
	})
</script>
<script>
	$(document).ready(function() {
		$('#list').dataTable()
		$('.view_user').click(function() {
			uni_modal("<i class='fa fa-id-card'></i> User Details", "view_user.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_user').click(function() {
			_conf("¿Estás seguro de eliminar a este usuario?", "delete_user", [$(this).attr('data-id')])
		})
	})

	function delete_user($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_user',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Datos eliminados con éxito", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>