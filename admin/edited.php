<?php
if($_POST){
	?> 
<?php
include("config.php");  
if($_POST){ 
$serverid = $_POST['eserverid'];
$bottoken = $_POST['ebottoken'];
$invitelink = $_POST['einvitelink'];
$id = $_POST['eid'];
$add = "UPDATE `servers` SET `serverid` = '$serverid', `bottoken` = '$bottoken', `invite` = '$invitelink' WHERE `id` = '$id'";
$result = mysqli_query($conn, $add);
if ( false===$result ) {
		 								echo 'Problem! <a href="admin.php">click if your browser dont support auto redirect <br></a>';
			header("Refresh: 3; url=admin.php"); 
	  printf("error: %s\n", mysqli_error($conn));

}
else { ?> <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Wait</title>
  </head>
  <body>
    <div class="row begin-countdown">
  <div class="col-md-12 text-center">
    <progress value="3" max="3" id="pageBeginCountdown"></progress>
    <p>Succesfully Edited! Wait for <span id="pageBeginCountdownText">3 </span> seconds <a href="admin.php">click if your browser dont support auto redirect</a></p>
  </div>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript">ProgressCountdown(3, 'pageBeginCountdown', 'pageBeginCountdownText')
function ProgressCountdown(timeleft, bar, text) {
  return new Promise((resolve, reject) => {
    var countdownTimer = setInterval(() => {
      timeleft--;

      document.getElementById(bar).value = timeleft;
      document.getElementById(text).textContent = timeleft;

      if (timeleft <= 0) {
        clearInterval(countdownTimer);
        resolve(true);
      }
    }, 1000);
  });
}</script>
  </body>
</html>
								 <?php
			header("Refresh: 3; url=admin.php");
}
} 

?>
<?php }else { echo 'Incorrect Method!';


}
  if(!isset($_SESSION["login"])){ 

 header("Refresh: 0; url=index.php"); 


 }else {
  
 }
?>