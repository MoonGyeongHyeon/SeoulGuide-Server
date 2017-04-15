<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$sight_id = $_POST['SIGHT_ID'];

$query = "select * from SIGHT1100 where SIGHT_ID='$sight_id' order by SIGHT_IMAGE_ID asc";
$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'SIGHT_IMAGE_FILEPATH'=>$row[SIGHT_IMAGE_FILEPATH], 
'SIGHT_IMAGE_FILENAME'=>$row[SIGHT_IMAGE_FILENAME] 
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>
