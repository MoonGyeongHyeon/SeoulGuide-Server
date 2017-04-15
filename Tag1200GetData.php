<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$query = "select * from TAG1200";
$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'sight'=>$row[SIGHT_ID], 
'tag_id'=>$row[TAG_ID]
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>