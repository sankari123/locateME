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
//print $_GET["lat1"];
 // this is the workaround for file_get_contents(...)
 // echo $_GET["lat1"];
  $master = array();
  $myArray= array();
  if(isset($_GET['lat1']) && $_GET['long1']!='')
  {
$lat1=trim($_GET["lat1"]);
$long1=trim($_GET["long1"]);
$csv_output='';
$sSQL= "SELECT loc_id, addr1,addr2,addr3,addr4,addr5,phone,latitude,longitude, ( 6371 * acos( cos( radians($lat1) ) * cos( radians( DIVE_LOC.latitude ) ) * cos( radians(DIVE_LOC.longitude) - radians($long1)) + sin(radians($lat1))  * sin( radians(DIVE_LOC.latitude)))) AS distance FROM DIVE_LOC HAVING distance < 30 ORDER BY distance LIMIT 0 , 11";
//$sSQL= "SELECT loc_id, addr1 from DIVE_LOC";
//echo $sSQL;
$result = mysql_query($sSQL);
//$numberOfRows = mysql_num_rows($result);
$numberOfRows = mysql_num_rows($result);
//echo $numberOfRows;
if ($numberOfRows>0) {
    for ($i = 0; $i < $numberOfRows; $i++) {
        $db_field = mysql_fetch_assoc($result);
		$text1=str_replace("'","\'",$db_field['addr1']);
		//$csv_output .= $row['loc_id'].",".$row['addr1']."\n";
		$csv_output .= $db_field['latitude'].",".$db_field['longitude'].",".$text1.",".$db_field['addr2'].",".$db_field['addr3'].",".$db_field['addr4'].",".$db_field['addr5'].",".$db_field['phone']."<br>";
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
  echo "<br />";
  foreach ($master as $value) {
	  
  // echo $value . "<br />";
  
  }

  foreach ($master as $value) {
	 // echo $value . "<br />";
    $myArray = explode(',', $value);
	foreach($myArray as $my_Array){
   // echo $my_Array.'<br>';  
   
}
  }
  echo "<br />";
 
		 
echo "<br />";

?>
<script>


//var js-variable = "<?= $master[0] ?>";
function test()
{
	var testStr;
	var js_array = [<?php echo '"'.implode('","', $master).'"' ?>];
    alert(js_array[0]);
	var index;

  var list = document.getElementById('anrede');

  js_array.forEach(function(item){
   var option = document.createElement('option');
   delimiter = ',';
   start = 1;
   result = item.split(delimiter, start+1).join(delimiter);
   option.value = result;
   list.appendChild(option);
});
window.location.href="index.html?locArray="+js_array;
}


//str = js_array[0];
//alert(str);
  //  delimiter = ',';
   // start = 1;
   // result = str.split(delimiter, start+1).join(delimiter);
//document.getElementById("loc1").value= result;





   
   
 function pop()
 {
	
	 var c = document.getElementById("myCanvas");
			var ctx = c.getContext("2d");
			ctx.clearRect(0,0,c.width, c.height);
   		   c.width = window.innerWidth;
			c.height = window.innerHeight;
           var google_tile = "http://maps.google.com/maps/api/staticmap?sensor=false&center=" + latitude + "," +longitude + "&zoom=19&size="+c.width+"x"+c.height+"&markers=color:blue|label:U|" +latitude + ',' + longitude;
			//var google_tile = "http://maps.google.com/maps/api/staticmap?sensor=false&center=" + latitude + "," +longitude + "&zoom=19&size=300x400&markers=color:blue|label:U|" +latitude + ',' + longitude;
            var canvas = document.getElementById("myCanvas");
            var context = canvas.getContext("2d");   
            var imageObj = new Image();
            imageObj.src = google_tile;
            
            imageObj.onload = function(){
              context.drawImage(imageObj, 0, 0);
            }
			
	
}

</script>
<body onload="test();">

<input name="loc_fnd" list="anrede" />
<datalist id="anrede"></datalist>


<textarea  id=a1 cols=100 rows=5 > <?php echo $master[0] ?></textarea><br>
<input type=text id=loc[0]  size=60 value=<?php echo $a[0]?>><br>
<input type=text id=loc[1]  size=60 value=<?php echo $a[0]?>><br>
<input type=text id=loc[2]  size=60 value=<?php echo $a[1]?>><br>
<input type=text id=loc[3]  size=60 value=<?php echo $a[2]?>><br>
<input type=text id=loc[4]  size=60 value=<?php echo $master[0]?>><br>
<input type=text id=loc[5]  size=60 value=<?php echo $master[0]?>><br>
<input type=text id=loc[6]  size=60 value=<?php echo $master[0]?>><br>

</body>

<canvas id="myCanvas">

</canvas>
