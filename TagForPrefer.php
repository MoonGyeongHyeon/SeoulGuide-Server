<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$tag_1 = $_POST['TAG_1'];
$tag_2 = $_POST['TAG_2'];
$tag_3 = $_POST['TAG_3'];

$query = "select DISTINCT(SIGHT_ID) from TAG1200 where TAG_ID='$tag_1' and TAG_ID='$tag_2' or TAG_ID='$tag_3' order by SIGHT_ID desc";

$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'sight_id'=>$row[SIGHT_ID]
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>
