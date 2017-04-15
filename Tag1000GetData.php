<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$query = "select * from TAG1000";
$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'tag_group_id'=>$row[TAG_GROUP_ID], 
'tag_group_name'=>$row[TAG_GROUP_NAME]
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>