
 

<?php
include 'admin/config.php';

?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Discordweb</title>
  </head>
  <body>




<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th>#</th>
      <th>Server Name</th>
      <th>Active Users</th>
      <th>Server Location</th>
      <th>More</th>
    </tr>
  </thead>
    <TBODY>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      <?php
        $get_servers = mysqli_query($conn, "SELECT * FROM servers");
      while($print_sv = mysqli_fetch_array($get_servers)){
      $invitelink = $print_sv['invite'];
      $serverid = $print_sv['serverid'];
      $token = $print_sv['bottoken'];
      $getid = $print_sv['id'];


$members = json_decode(file_get_contents('https://discordapp.com/api/guilds/'.$serverid.'/widget.json'), false);
$veri_cek = [
  "http" => [
    "method" => "GET",
    "header" => "Authorization: Bot ".$token.""
  ]
];

$json_context = stream_context_create($veri_cek);




$infos     = file_get_contents('https://discordapp.com/api/guilds/'.$serverid.'?with_counts=true', false, $json_context);

$counter  = json_decode($users, true);

$svname  = json_decode($infos, false);

?>
      <tr>
      <td>    <?php if(!$svname->icon){ echo '#'; } else{ echo '<img src="https://cdn.discordapp.com/icons/'.$serverid.'/'; echo $svname->icon;  echo '"class="rounded-circle" alt="Sunucu Icon" width="30px" heigh="30px">'; }?></td>
      <td><?php if(!$svname->name){echo 'NO INFO';}else{ echo $svname->name; }?></td>
      <td><?php 
      if(!$members->presence_count) {
        echo 'NO INFO';

      }else{
      echo $members->presence_count; }
     ?> / <?php if(!$svname->approximate_member_count) {
        echo 'NO INFO';

      }else{
      echo $svname->approximate_member_count; }  ?> </td>
      <td style="text-transform: capitalize;"><?php if(!$svname->region){ echo "NO INFO";}else{ echo $svname->region; }?></td>
      <td><a href="<?php echo $invitelink ?>">Connect</a> || <a href="serverstats.php?id=<?php echo $getid; ?>">Details</a></td>
    </tr>
   


      <?php } ?>
 </TBODY>

</table>
 <?php if(!$veri_cek){ echo '<div class="alert alert-secondary" role="alert">
  There are no servers or database problems!
</div>'; }else { } ?>

  </body>
      <hr>
    <center><strong>discordweb v1.0</strong> by <a href="https://emircanyildirim.com" target="_blank">Emircan Yıldırım</a> for anything contact with me from discord <i>ecy#2505</i>  <a href="about.html" target="_blank">About Script</a> </center>
      <br>


</html>
