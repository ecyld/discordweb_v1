<?php
include("config.php");


if(!isset($_SESSION["login"])){ ?>

<?php header("Refresh: 0; url=index.php"); ?>


<?php }
else{
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Discordweb Admin Panel</title>

  <body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="admin.php">Discordweb</a>
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="admin.php">Admin Panel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="../">Server List</a>
      </li>
            <li class="nav-item">
        <a class="nav-link" target="_blank" href="../about.html">About Script</a>
      </li>
    </ul>
    <span class="navbar-text">
     <a href="logout.php" class="nav-link">Log Out</a>
    </span>
  </div>
</nav>
<div class="container">
<center>  <h3 class="mt-3">Add Server</h3> </center>
  <form action="" method="POST">
    <div class="row">

    <div class="col">
<label>Server ID:</label><input class="form-control" type="text" name="serverid" required> 
    </div>
    <div class="col">
 <label>Bot Token: </label><input  class="form-control" type="text" name="bottoken" required>
    </div>
    <div class="col">
 <label>Invite Link: </label><input type="text"  class="form-control" name="invitelink" value="https://discord.gg/" required>
  </div>
  </div>
  <center>
   <input type="submit" class="btn btn-success mt-2 justify-content-center" value="Add"></center>
</form>
</div>

<?php
if($_POST){ 
$serverid = $_POST['serverid'];
$bottoken = $_POST['bottoken'];
$invitelink = $_POST['invitelink'];
$add = "INSERT INTO `servers` (`serverid`, `bottoken`, `invite`) VALUES ('$serverid', '$bottoken', '$invitelink')";
$result = mysqli_query($conn, $add);
if ( false===$result ) {
?>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>swal("Error!", "There was a problem : <?php echo mysqli_error($conn); ?>", "error");
</script>
<?php
}
else { ?>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>swal("Succesfully!", "You added a new server!", "success");
</script>
<?php
}
} ?><div class="container">
  <hr>
      <center><h3>Server Editor</h3> </center>
<?php
      $get_servers = mysqli_query($conn, "SELECT * FROM servers");
      while($print_sv = mysqli_fetch_array($get_servers)){
      $svinvitelink = $print_sv['invite'];
      $svserverid = $print_sv['serverid'];
      $svtoken = $print_sv['bottoken'];
      $svid = $print_sv['id'];

?>
      <?php
      $veri_cek = [
  "http" => [
    "method" => "GET",
    "header" => "Authorization: Bot ".$svtoken.""
  ]
]; 
$json_context = stream_context_create($veri_cek);
$infos     = file_get_contents('https://discordapp.com/api/guilds/'.$svserverid.'', false, $json_context);
$svname  = json_decode($infos, false);
?>
<?php if(!($svname OR $infos)){ echo '<strong>Incorrect Server!</strong>'; }else{ echo ' <hr><center> <strong>'.$svname->name.'</strong> </center>'; }?>
<br>

  <form action="edited.php" id="edit" method="POST">
    <div class="row">
    <div class="col">
   <label> MySQL ID: </label><input type="text" class="form-control" readonly name="eid" required value="<?php echo $svid ?>"> </div>
   <div class="col">
  <label>  Server Dev. ID: </label><input type="text" class="form-control" name="eserverid" required value="<?php echo $svserverid ?>"> </div>
  <div class="col">
     <label> Bot Token: </label><input type="text" class="form-control" name="ebottoken" value="<?php echo $svtoken ?>" required> </div>
     <div class="col">
       <label> Invite Link:</label> <input type="text" class="form-control" name="einvitelink" required  value="<?php echo $svinvitelink ?>"> </div>    
          
          </div>
          <center>
          <input type="submit" class="btn btn-success" value="Edit" style="margin-top:5px">
              <input type="button" id="btn-submit" class="btn btn-danger" value="Delete!" onclick="al()" style="margin-top:5px"> </center>
      </form>
          <form action="delete_item.php" id="delete" method="POST">
      <div style="display: none;">
    Server ID: <input type="text" name="serverid" readonly required value="<?php echo $svserverid ?>">
      Bot Token: <input type="text" name="bottoken" readonly value="<?php echo $svtoken ?>" required>
        Invite Link (Make Permantent): <input type="text" readonly name="invitelink" required  value="<?php echo $svinvitelink ?>">  <input type="text" readonly name="id" required value="<?php echo $svid ?>">  </div>

      </form>

<br />
  </body>
  <?php
}
?>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>
<script type="text/javascript">
function al() {
swal({
  title: "Delete Server",
  text: "Sure About That?",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) document.getElementById("delete").submit();

});
};
    </script>


<?php
}
?>
