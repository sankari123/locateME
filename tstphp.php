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
print $_GET["lat1"];
 // this is the workaround for file_get_contents(...)
  echo $_GET["lat1"];
  if(isset($_GET['lat1']) && $_GET['long1']!='')
  {
$lat1=trim($_GET["lat1"]);
$long1=trim($_GET["long1"]);
$csv_output='';
$sSQL= "SELECT loc_id, addr1,addr2,addr3,addr4,addr5,phone,latitude,longitude, ( 6371 * acos( cos( radians($lat1) ) * cos( radians( DIVE_LOC.latitude ) ) * cos( radians(DIVE_LOC.longitude) - radians($long1)) + sin(radians($lat1))  * sin( radians(DIVE_LOC.latitude)))) AS distance FROM DIVE_LOC HAVING distance < 30 ORDER BY distance LIMIT 0 , 11";
//$sSQL= "SELECT loc_id, addr1 from DIVE_LOC";
echo $sSQL;
$result = mysql_query($sSQL);
//$numberOfRows = mysql_num_rows($result);
$numberOfRows = mysql_num_rows($result);

if ($numberOfRows>0) {
    for ($i = 0; $i < $numberOfRows; $i++) {
        $db_field = mysql_fetch_assoc($result);
		$text1=str_replace("'","\'",$db_field['addr1']);
		//$csv_output .= $row['loc_id'].",".$row['addr1']."\n";
		$csv_output .= $db_field['latitude'].",".$db_field['longitude'].",".$text1.",".$db_field['addr2'].",".$db_field['addr3'].",".$db_field['addr4'].",".$db_field['addr5'].",".$db_field['phone']."<br>";
			
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
print rtrim($csv_output);
exit;
?>
