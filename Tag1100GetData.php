<?php

$connect = mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$query = "select * from TAG1100";
$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'tag_id'=>$row[TAG_ID],
'tag_name'=>$row[TAG_NAME],
'tag_group_id'=>$row[TAG_GROUP_ID]
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>