<?php
$user_name = 'dive2016';
$password = 'Anusha123#';
$database = 'dive2016';
$server = 'dive2016.db.5014787.hostedresource.com';


mysql_connect("dive2016.db.5014787.hostedresource.com", "dive2016", "Anusha123#") or die(mysql_error()); 
mysql_select_db("dive2016") or die(mysql_error());  
  $master = array();
  $myArray= array();
  if(isset($_POST['lat1']) && $_POST['long11']!='')
  {
$lat1=trim($_POST["lat1"]);
$long11=trim($_POST["long11"]);
$csv_output='';
$sSQL= "SELECT loc_id, addr1,addr2,addr3,addr4,addr5,phone,latitude,longitude, ( 6371 * acos( cos( radians($lat1) ) * cos( radians( diveLoc.latitude ) ) * cos( radians(diveLoc.longitude) - radians($long11)) + sin(radians($lat1))  * sin( radians(diveLoc.latitude)))) AS distance FROM diveLoc HAVING distance < 30 ORDER BY distance LIMIT 0 , 11";
$result = mysql_query($sSQL);
$numberOfRows = mysql_num_rows($result);
if($result===FALSE)
{
	die(mysql_error());
}

if ($numberOfRows>0) {
    for ($i = 0; $i < $numberOfRows; $i++) {
        $db_field = mysql_fetch_assoc($result);
		$text1=str_replace("'","\'",$db_field['addr1']);
		$csv_output .= $db_field['latitude'].",".$db_field['longitude'].",".$text1.",".$db_field['addr2'].",".$db_field['addr3'].",".$db_field['addr4'].",".$db_field['addr5'].",".$db_field['phone']."#";
		$master[$i]=$db_field['latitude'].",".$db_field['longitude'].",".$text1.",".$db_field['addr2'].",".$db_field['addr3'].",".$db_field['addr4'].",".$db_field['addr5'].",".$db_field['phone'];
    }
}
else
{
	$csv_output="";
}
 $csv_output = rtrim($csv_output, ",");
if ($numberOfRows>0) {
}
else
{
	$csv_output=0;
}
  }
 echo $csv_output;
  
?>
