<?php
if($_POST){
	?>
<?php
include 'config.php';

	$id = $_POST["id"];
	if(is_numeric($id)){
		$ask_server = mysqli_query($conn, "SELECT * FROM servers WHERE id='".$id."'");
		$control = mysqli_num_rows($ask_server);
		if($control > 0){

			
					$delete="DELETE FROM servers WHERE id='$id'";
					if(mysqli_query($conn, $delete)){
								echo 'Succesfully Deleted <a href="admin.php">click if your browser dont support auto redirect</a>';
			header("Refresh: 0; url=admin.php");
					}else{
								echo 'delete problem <a href="admin.php">click if your browser dont support auto redirect</a>';
			header("Refresh: 0; url=admin.php");
					}
					
				}else{
								echo 'incorrect post method! <a href="admin.php">click if your browser dont support auto redirect</a>';
			header("Refresh: 0; url=admin.php");
		}
	}	

}else  {
 echo 'Incorrect post method';
 header("Refresh: 0; url=../");

}
  if(!isset($_SESSION["login"])){ 

 header("Refresh: 0; url=index.php"); 


 }else {
  
 }
?>