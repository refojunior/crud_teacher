<?php 

include "koneksi.php";

switch ($_GET['fungsi']) {
	case 'add':
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phoneNumber = $_POST['phone_number'];
		$class = $_POST['class'];

		$insert = $db->query("INSERT INTO teacher VALUES ('', '$name', '$email', '$phoneNumber', '$class')");

		if($insert) {
			echo "<script>alert('Successfully'); location.href='index.php'</script>";
		} else {
			echo "<script>alert('Failed'); location.href='index.php'</script>";
		}

		break;

	case 'edit' :
		$id = $_GET['id'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phoneNumber = $_POST['phone_number'];
		$class = $_POST['class'];

		$update = $db->query("UPDATE teacher SET 
			name = '$name', 
			email = '$email', 
			phone_number = '$phoneNumber', 
			id_class = '$class' 
			WHERE id = $id ");

		if($update) {
			echo "<script>alert('Successfully updated'); location.href='index.php'</script>";
		} else {
			echo "<script>alert('Failed updated'); location.href='index.php'</script>";
		}
		break;

	case 'delete' :
		$id = $_GET['id'];

		$del = $db->query("DELETE FROM teacher WHERE id = '$id' ");

		if($del) {
			echo "<script> location.href='index.php'</script>";
		} else {
			echo "<script>alert('Failed deleted'); location.href='index.php'</script>";
		}

		break;
}



 ?>