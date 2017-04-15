<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$sight_id = $_POST['SIGHT_ID'];

$query = "select * from REVIEW1000 where SIGHT_ID='$sight_id' order by REVIEW_ID  desc";
$result = mysqli_query($connect, $query);

$resarray = array();

while($row = mysqli_fetch_array($result)){
array_push($resarray, array(
'review_id'=>$row[REVIEW_ID],
'review_writer'=>$row[REVIEW_WRITER], 
'review_info'=>$row[REVIEW_INFO], 
'review_date'=>$row[REVIEW_DATE], 
'review_point'=>$row[REVIEW_POINT], 
'sight_id'=>$row[SIGHT_ID]
));
}

echo json_encode(array("result"=>$resarray));

mysqli_close($connect);

?>
