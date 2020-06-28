
      <?php
      include 'admin/config.php';
			$ids = $_GET["id"];
			if(is_numeric($ids)){
				$check=mysqli_query($conn, "SELECT * FROM servers WHERE id='$ids'");
				while($answer = mysqli_fetch_array($check)){
				$idd=$answer['id'];
				$invitelink=$answer['invite'];
				$serverid=$answer['serverid'];
				$token=$answer['bottoken'];
				}
								$control_server = mysqli_query($conn, "SELECT * FROM servers where id='".$ids."'");
		
				$checkit = mysqli_num_rows($control_server);
				if($checkit > 0)
				{
				}else{
					echo 'Error! <br /> <meta http-equiv="refresh" content="0;URL=index.php">';
				}

$json_options = [
  "http" => [
    "method" => "GET",
    "header" => "Authorization: Bot ".$token.""
  ]
];

$json_context = stream_context_create($json_options);

$json_get     = file_get_contents('https://discordapp.com/api/guilds/'.$serverid.'/members?limit=1000', false, $json_context);

$infos     = file_get_contents('https://discordapp.com/api/guilds/'.$serverid.'', false, $json_context);
$svname  = json_decode($infos, false);
$json_decode  = json_decode($json_get, true);
if($_GET){
      ?>
<?php if (!$json_decode) {
	echo 'CANT GET SERVER INFO!';
}else { ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?php echo $svname->name; ?> Server Stats</title>
  </head>
  <body>



<?php




 
 $all = count($json_decode);



$bots = array_column(array_column($json_decode, 'user'), 'bot');


$botcalc = count($bots);

$users =$all-$botcalc;




/*
echo '<h2>JSON Output</h2>';
echo '<pre>';
print_r($json_decode);
echo '</pre>'; */


sort($json_decode);

?>


	<table class="table table-dark">
	<thead>
				<tr>
						<td>
		<?php echo $svname->name; ?> Server Users
	</td>
	<td>
		<?php echo count($bots); ?> BOTs
	</td>
		<td>
		<?php echo $users; ?> Real Users
	</td>
			<td>
		<?php echo count($json_decode); ?> Total Users
	</td>
</tr>
		<th>#</th>
	 <th>Username</th> 
		<th>Joined at </th>
		<th>User Type</th>  
		</thead>

<?php echo '<tbody>'; ?>
<?php foreach ($json_decode as $key => $value) {
	$user = $value["user"]["username"];
	$joined = $value["joined_at"];
	$pp = $value["user"]["avatar"];
	$idcek = $value["user"]["id"];
	$bot = @$value["user"]["bot"];

	
if (isset($pp)) {
	echo '<tr>  <td> <img src="https://cdn.discordapp.com/avatars/'.$idcek.'/'.$pp.'" width="30px" height="30px" class="rounded-circle"></img> </td> ';
}else {

	echo '<tr>  <td> <img src="https://cdn.discordapp.com/icons/'.$serverid.'/'.$svname->icon.'" width="30px" height="30px" class="rounded-circle"></img> </td>';
}

	

	

    
			 echo ' <td>'.$user.'</td>';

		echo '<td>'.$joined.'</td> ';
		if(isset($bot)){ echo ' <td><span class="badge badge-primary">BOT</span></td></tr>';

		}else { echo ' <td><span class="badge badge-success">NOT-BOT</span></td></tr>';

		}
} ?>

  </tbody>

</table>



	
	


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php } ?> <?php }else {

	echo ' Unauthorized <meta http-equiv="refresh" content="0;URL=index.php">';

} 

}?>