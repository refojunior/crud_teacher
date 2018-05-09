<?php 
include"koneksi.php"; 

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = $db->query("SELECT * FROM teacher WHERE id = '$id'");
	while($data = $query->fetch(PDO::FETCH_ASSOC)){
		$id = $data['id'];
		$name = $data['name'];
		$email = $data['email'];
		$phone_number = $data['phone_number'];
		$kls = $data['id_class'];
	}

	if($name==""){
		$modal=0;
	} else {
		$modal=1;
	}
?>	
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<title>CRUD Teacher</title>
</head>
<body>
	<div class="container">
		<h1>CRUD DATA TEACHER</h1>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#teacherModal">
		  			Add Data
				</button>
			</div>	
		</div>
		<br>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-sm">
					<tr>
						<th>No</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone Number</th>
						<th>Class</th>
						<th>Action</th>
					</tr>
					<?php
						$no = 1; 
						$dataTeacher = $db->query("SELECT * FROM teacher INNER JOIN class on class.id_class = teacher.id_class"); 
	
						foreach($dataTeacher as $row){ ?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $row['name'] ?></td>
						<td><?= $row['email'] ?></td>
						<td><?= $row['phone_number'] ?></td>
						<td><?= $row['class_name'] ?></td>
						<td>
							<a href="<?= 'index.php?id='.$row['id'] ?>" class="btn btn-sm btn-warning">Edit</a> | 
							<a href="proses.php?fungsi=delete&id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Hapus</a>
						</td>
					</tr>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="teacherModal">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		        <div class="modal-header">
			        <h5 class="modal-title">Form Teacher</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
		        </div>
		      	<form action="proses.php?fungsi=<?= ($name=='' ? 'add' : 'edit&id='.$id) ?>" method="post">
			      	<div class="modal-body">
					
				        <p>Name</p>
				        <input type="text" class="form-control" name="name" value="<?= $name ?>" required>

				        <p>Email</p>
				        <input type="text" class="form-control" name="email" value="<?= $email ?>" required>

				        <p>Phone Number</p>
				        <input type="text" class="form-control" name="phone_number" value="<?= $phone_number ?>" required>
						
				        <p>Class</p>
				        <select name="class" class="form-control">
				        	<option value="">- Select -</option>
					        <?php $class = $db->query("SELECT * FROM class"); 
								foreach($class as $kelas){ ?>
				        		<option value="<?= $kelas['id_class'] ?>" <?= ($kelas['id_class']==$kls ? 'selected' : '') ?>><?= $kelas['class_name'] ?></option>
				        	<?php } ?>
				        </select>
				        
			      	</div>
			      	<div class="modal-footer">
			        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        	<input type="submit" class="btn btn-primary" value="Save Data"></button>
			      	</div>
			  	</form>
		    </div>
		</div>
	</div>

	
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<?php if ($modal == 1) { ?>
		<script type="text/javascript">
	    $(window).on('load',function(){
	        $('#teacherModal').modal('show');
	    });
		</script>
	<?php } ?>

	<script>
	$(".modal").on("hidden.bs.modal", function(){
	    window.location = "index.php";
	});
	</script>

	<?php } else {
		$_GET['id'] = ''; 
		include("index.php");
	} ?>
</body>
</html>