<?php include '../Header.php'; ?> 


<?php

$code= $_GET['code'];
$level= $_GET['level'];
$match= $_GET['match'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://frc-api.firstinspires.org/v3.0/2023/scores/'.$code.'/'.$level.'?matchNumber='.$match,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'If-Modified-Since: ',
    'Authorization: Basic '.$frcCode
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$final = json_decode($response, true);

$output.="<ul>";

foreach($final['MatchScores'] as $MatchScores){

	$output.="<h3>".$MatchScores['matchLevel'].": ".$MatchScores['matchNumber']."</h3>";

  $output.="<br>";

  foreach($MatchScores['alliances'] as $alliances){

    if ($alliances['alliance']['red']) {
      $output.='<div class="alert alert-danger" role="alert">';
     
      $output.='</div>';
    }
  }
    foreach($MatchScores['alliances'] as $alliances){

      if ($alliances['alliance']['blue']) {
        $output.='<div class="alert alert-info" role="alert">';
       
        $output.='</div>';
      }
    }
    
  


}

$output.="<br>";

$output.="</ul>";

echo $output;

?>

<br><br>

<a href="/matchResults" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Go Back</a>


<script>
$(document).ready(function(){
  $(".dropdown-toggle").dropdown("toggle");
});
</script>



</body>
</html>