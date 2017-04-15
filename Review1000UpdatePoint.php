<?php

$connect=mysqli_connect('localhost', 'jdh', 'wkdehdgur', 'seoul_guide')
or die("failed");

mysqli_set_charset($connect, "utf8");

$sight_id = $_POST['SIGHT_ID'];
$sum_point = $_POST['SUM_POINT'];

$query = "update SIGHT1000 set SUM_POINT=SUM_POINT+$sum_point, P_COUNT=P_COUNT+1 where SIGHT_ID='$sight_id'";

$result = mysqli_query($connect, $query);

echo json_encode($row);

mysqli_close($connect);

?>
