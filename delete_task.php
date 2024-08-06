<?php $get_id = $_GET['id']; ?>
<?php 
	 if (isset($_GET['id'])) {

		$servername = "localhost";
		$username   = "root";
		$password   = "";
		$dbname     = "office";
		$conn       = mysqli_connect($servername,$username,$password,$dbname);

		$department_id = $_GET['id'];
		$sql = "DELETE FROM tasks where t_id = ".$department_id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>alert('task deleted Successfully');</script>";
     		echo "<script type='text/javascript'> document.location = 'manage_task.php'; </script>";
			
		}
	}
?>