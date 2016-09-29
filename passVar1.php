<?php
DEFINE ('DBUSER', 'AndroidDb1'); 
DEFINE ('DBPW', 'Peace4all#'); 
DEFINE ('DBHOST', 'AndroidDb1.db.5014787.hostedresource.com'); 
DEFINE ('DBNAME', 'AndroidDb1'); 
$user_name = 'AndroidDb1';
$password = 'Peace4all#';
$database = 'AndroidDb1';
$server = 'AndroidDb1.db.5014787.hostedresource.com';


mysql_connect("AndroidDb1.db.5014787.hostedresource.com", "AndroidDb1", "Peace4all#") or die(mysql_error()); 
mysql_select_db("AndroidDb1") or die(mysql_error());  
  $master = array();
  $myArray= array();
  if(isset($_POST['lat1']) && $_POST['long11']!='')
  {
$lat1=trim($_POST["lat1"]);
$long11=trim($_POST["long11"]);
$csv_output='';
$sSQL= "SELECT loc_id, addr1,addr2,addr3,addr4,addr5,phone,latitude,longitude, ( 6371 * acos( cos( radians($lat1) ) * cos( radians( DIVE_LOC.latitude ) ) * cos( radians(DIVE_LOC.longitude) - radians($long11)) + sin(radians($lat1))  * sin( radians(DIVE_LOC.latitude)))) AS distance FROM DIVE_LOC HAVING distance < 30 ORDER BY distance LIMIT 0 , 11";
$result = mysql_query($sSQL);
$numberOfRows = mysql_num_rows($result);

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
