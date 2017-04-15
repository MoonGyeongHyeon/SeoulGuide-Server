<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$id = $_POST['SIGHT_ID'];

$query = "select * from REVIEW1000 where SIGHT_ID='$id' order by REVIEW_DATE desc";

$result = mysqli_query($connect, $query);

$reviewArray = array();

while($row = mysqli_fetch_array($result)) {
array_push($reviewArray, array(
'review_writer'=>$row[REVIEW_WRITER],
'review_info'=>$row[REVIEW_INFO],
'review_date'=>$row[REVIEW_DATE],
'review_point'=>$row[REVIEW_POINT]
));
}

echo json_encode(array("result"=>$reviewArray));

mysqli_close($connect);

?>
